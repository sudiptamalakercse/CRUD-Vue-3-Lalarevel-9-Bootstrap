<template>
	<aside class="left-sidebar" data-sidebarbg="skin5">
		<!-- Sidebar scroll-->
		<div class="scroll-sidebar">
			<!-- Sidebar navigation-->
			<nav class="sidebar-nav">
				<ul id="sidebarnav" class="pt-4">
					<li class="sidebar-item d-md-none">
						<!-- <div class="sidebar-link text-center">User</div> -->
						<a
							ref="admin_or_user_icon"
							href="javascript:void(0)"
							aria-expanded="false"
							><i
								v-if="is_admin_authenticate"
								class="mdi mdi-account-circle"
							></i>
							<i v-if="is_user_authenticate" class="mdi mdi-account"></i>

							<span
								v-if="is_admin_authenticate || is_user_authenticate"
								class="hide-menu"
								>{{ user_data.name }} ({{ user_data.email }})</span
							></a
						>
						<ul
							v-if="is_admin_authenticate || is_user_authenticate"
							aria-expanded="false"
							class="collapse first-level"
						>
							<li
								@click="onLogOut"
								:class="{
									disable_btn: is_btn_deactive,
									'sidebar-item': true
								}"
								style="cursor: pointer"
							>
								<span class="sidebar-link">
									<i class="mdi mdi-power"></i
									><span class="hide-menu"> Log Out </span>
								</span>
							</li>
						</ul>
					</li>
					<li class="sidebar-item d-md-none">
						<a ref="posts_icon" href="javascript:void(0)" aria-expanded="false"
							><i
								class="mdi mdi-receipt"
							></i
							><span
								class="hide-menu"
								>Posts</span
							></a
						>
						<ul	aria-expanded="false"
							class="collapse first-level"
						>
							<li class="sidebar-item">
								<router-link
									:to="{ name: 'add_post_by_admin' }"
									class="sidebar-link"
									><i class="mdi mdi-plus-circle"></i
									><span class="hide-menu"> Add Post </span>
								</router-link>
							</li>
							<li
								class="sidebar-item"
							>
								<router-link
									:to="{ name: 'show_posts_for_admin_and_user' }"
									class="sidebar-link"
									><i class="mdi mdi-view-list"></i
									><span class="hide-menu"> View All Posts </span>
								</router-link>
							</li>
						</ul>
					</li>

					<li class="sidebar-item p-3">
						<a
							href="https://www.facebook.com/sudipta.malaker.1"
							target="_blank"
							class="w-100 btn btn-primary d-flex align-items-center text-white"
							><i class="mdi mdi-facebook-box font-20 me-2"></i>Facebook of
							Developer</a
						>
					</li>
				</ul>
			</nav>
			<!-- End Sidebar navigation -->
		</div>
		<!-- End Sidebar scroll-->
	</aside>
</template>

<script>
import useIsAuthenticate from '../../composables/getters/is_authenticate_composable';
import { ref, onUpdated, onMounted } from 'vue';
import useLogOutComposable from '../../composables/log_out_composable';
import { log_out_ } from '../../services/generel';

export default {
	name: 'LeftSidebarComponent',
	setup() {
		const { is_admin_authenticate, is_user_authenticate, user_data } =
			useIsAuthenticate();

		const admin_or_user_icon = ref(null);
		const posts_icon = ref(null);
	
		const log_in_icon = ref(null);

		const { log_out, is_btn_deactive } = useLogOutComposable();

		const onLogOut = () => {
			log_out_(is_admin_authenticate, is_user_authenticate, user_data, log_out);
		};
		const add_class_to_admin_or_user_icon = () => {
			if (is_admin_authenticate.value || is_user_authenticate.value) {
				admin_or_user_icon.value.classList.add('sidebar-link');
				admin_or_user_icon.value.classList.add('has-arrow');
				admin_or_user_icon.value.classList.add('waves-effect');
				admin_or_user_icon.value.classList.add('waves-dark');
			} else {
				admin_or_user_icon.value.classList.remove('sidebar-link');
				admin_or_user_icon.value.classList.remove('has-arrow');
				admin_or_user_icon.value.classList.remove('waves-effect');
				admin_or_user_icon.value.classList.remove('waves-dark');
			}
		};

		const add_class_to_posts_icon = () => {

				posts_icon.value.classList.add('sidebar-link');
				posts_icon.value.classList.add('has-arrow');
				posts_icon.value.classList.add('waves-effect');
				posts_icon.value.classList.add('waves-dark');
			
		};



		onUpdated(() => {
			add_class_to_admin_or_user_icon();
			add_class_to_posts_icon();


		});

		onMounted(() => {
			add_class_to_admin_or_user_icon();
			add_class_to_posts_icon();

		});

		return {
			is_admin_authenticate,
			is_user_authenticate,
			user_data,
			admin_or_user_icon,
			posts_icon,
			onLogOut,
			log_in_icon,
			is_btn_deactive
		};
	}
};
</script>

<style scoped>
.disable_btn {
	cursor: not-allowed;
	pointer-events: none;

	/*Button disabled - CSS color class*/
	color: #c0c0c0;
	background-color: #141313;
}
.sidebar-item .router-link-exact-active {
	background: #27a9e3;
}
</style>
