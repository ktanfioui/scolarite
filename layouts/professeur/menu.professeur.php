	<div class="left_nav">
      <div class="space-top space-bot"></div>
      <div class="left_nav_slidebar">
        <ul>

          <li <?php echo ($menu_tab == "filiere") ? 'class="left_nav_active theme_border"' : ''; ?>>
            <a href="javascript:void(0);">
              <i class="fa fa-bookmark"></i> Filières <?php echo ($menu_tab == "filiere") ? '<span class="left_nav_pointer"></span>' : ''; ?><span class="plus"><i class="fa fa-plus"></i></span>
            </a>
            <ul <?php echo ($menu_tab == "filiere") ? 'class="opened" style="display:block"' : ''; ?>>
              <li>
                <a href="listeFiliere.controller.php"><i class="fa fa-circle<?php echo ($menu_tab_sub == "listeFiliere") ? ' theme_color' : ''; ?>"></i> <b class="<?php echo ($menu_tab_sub == "listeFiliere") ? ' theme_color' : ''; ?>">Listes</b></a> 
              </li>
            </ul>
          </li>

          <li <?php echo ($menu_tab == "module") ? 'class="left_nav_active theme_border"' : ''; ?>> 
            <a href="javascript:void(0);"> 
              <i class="fa fa-tasks"></i> Modules <?php echo ($menu_tab == "module") ? '<span class="left_nav_pointer"></span>' : ''; ?><span class="plus"><i class="fa fa-plus"></i></span>
            </a>
            <ul <?php echo ($menu_tab == "module") ? 'class="opened" style="display:block"' : ''; ?>>
              <li> 
                <a href="listeModule.controller.php"><i class="fa fa-circle<?php echo ($menu_tab_sub == "listeModule") ? ' theme_color' : ''; ?>"></i> <b class="<?php echo ($menu_tab_sub == "listeModule") ? ' theme_color' : ''; ?>">Listes</b></a> 
              </li>
            </ul>
          </li>

          <li <?php echo ($menu_tab == "examen") ? 'class="left_nav_active theme_border"' : ''; ?>> 
            <a href="javascript:void(0);"> 
              <i class="fa fa-tasks"></i> Examens <?php echo ($menu_tab == "examen") ? '<span class="left_nav_pointer"></span>' : ''; ?><span class="plus"><i class="fa fa-plus"></i></span>
            </a>
            <ul <?php echo ($menu_tab == "examen") ? 'class="opened" style="display:block"' : ''; ?>>
              <li>
                <a href="creationExamen.controller.php"><i class="fa fa-circle<?php echo ($menu_tab_sub == "creationExamen") ? ' theme_color' : ''; ?>"></i> <b class="<?php echo ($menu_tab_sub == "creationExamen") ? ' theme_color' : ''; ?>">Création</b></a> 
              </li>
              <li>
                <a href="listeExamen.controller.php"><i class="fa fa-circle<?php echo ($menu_tab_sub == "listeExamen") ? ' theme_color' : ''; ?>"></i> <b class="<?php echo ($menu_tab_sub == "listeExamen") ? ' theme_color' : ''; ?>">Listes</b></a> 
              </li>
            </ul>
          </li>

          <li <?php echo ($menu_tab == "message") ? 'class="left_nav_active theme_border"' : ''; ?>> 
            <a href="javascript:void(0);"> 
              <i class="fa fa-envelope"></i> Message <?php echo ($menu_tab == "message") ? '<span class="left_nav_pointer"></span>' : ''; ?><span class="plus"><i class="fa fa-plus"></i></span>
            </a>
            <ul <?php echo ($menu_tab == "message") ? 'class="opened" style="display:block"' : ''; ?>>
              <li>
                <a href="newMessage.controller.php"><i class="fa fa-circle<?php echo ($menu_tab_sub == "newMessage") ? ' theme_color' : ''; ?>"></i> <b class="<?php echo ($menu_tab_sub == "newMessage") ? ' theme_color' : ''; ?>">Nouveau</b></a> 
              </li>
            </ul>
          </li>
		  
		  <li <?php echo ($menu_tab == "annonce") ? 'class="left_nav_active theme_border"' : ''; ?>> 
            <a href="javascript:void(0);"> 
              <i class="fa fa-tasks"></i> Annonces <?php echo ($menu_tab == "annonce") ? '<span class="left_nav_pointer"></span>' : ''; ?><span class="plus"><i class="fa fa-plus"></i></span>
            </a>
            <ul <?php echo ($menu_tab == "annonce") ? 'class="opened" style="display:block"' : ''; ?>>
              <li>
                <a href="creationAnnonce.controller.php"><i class="fa fa-circle<?php echo ($menu_tab_sub == "ajoutAnnonce") ? ' theme_color' : ''; ?>"></i> <b class="<?php echo ($menu_tab_sub == "ajoutAnnonce") ? ' theme_color' : ''; ?>">Ajouter</b></a> 
              </li>
              <li>
                <a href="listeAnnonce.controller.php"><i class="fa fa-circle<?php echo ($menu_tab_sub == "listeAnnonce") ? ' theme_color' : ''; ?>"></i> <b class="<?php echo ($menu_tab_sub == "listeAnnonce") ? ' theme_color' : ''; ?>">Listes</b></a> 
              </li>
            </ul>
          </li>
		  
          
        </ul>
      </div>
    </div>