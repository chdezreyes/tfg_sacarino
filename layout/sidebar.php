<!-- INI --- Logo -->
			<a href="../index.php" class="brand-link bg-white" style="height:60px">
				<span class="logo-mini">
					<img src="../resources/img/logo_icono.jpg" alt="Logo Gextiona" class="img-responsive brand-image img-circle" style="opacity: 1">
				</span>
				<span class="brand-text">
					<img src="../resources/img/logo_marca.jpg" alt="Logo Gextiona" class="img-responsive brand-image" style="opacity: 1">
				</span>
			</a>
<!-- FIN --- Logo -->

<!-- INI --SIDEBAR -->
		<section class="sidebar">
				<div class="mt-4"></div>
					<ul class="nav nav-pills nav-sidebar flex-column pl-1 pr-0 mr-1" data-widget="treeview" role="menu" data-accordion="false">

						<?php
								$menuId = null;

								if(isset($_GET["route"])){
									$menuElement = ControllerMenus::ctrGetMenu($_GET["route"]);
									$menuId = ControllerMenus::ctrGetFirstApp($menuElement);
									if($menuId){
										$menuId = $menuId['id'];
									}else{
										$menuId =null;
									}
								}

								if ($menuId) {
									$appElements = ControllerMenus::ctrGetMenuItemChildren($menuId);
														
									foreach ($appElements as $key => $value) {
											$selectedItem = 'active sidebar-selected';

											$fileName = pathinfo($value['menu_file'], PATHINFO_FILENAME);
											
											if($fileName != $_GET['route']){
												$selectedItem = '';
											}

											echo '<li class="nav-item ml-1 mr-0 pt-1 mb-0 pr-0">';
											echo ' <a class="nav-link ' . $selectedItem . ' mb-0 li-height" href="' . $fileName . '">';
											echo '   <div class="row mt-1 pt-2 align-items-center">';
											echo '     <span class="material-symbols-outlined">' . $value['menu_icon'] . '</span>';
											echo '     <p class="ml-3">' . $value["menu_name"] . '</p>';
											echo '   </div>';
											echo ' </a>';
											echo '</li>';
											
											if($fileName != $_GET['route']){
												$selectedItem = '';
											}else{
												$selectedItem = 'active sidebar-selected';
											}              
									}
							}
						?>
				</ul>
		</section>
<!-- FIN -- SIDEBAR -->

