	<div class="left_nav">
      <div class="space-top space-bot"></div>
      <div class="left_nav_slidebar">
        <ul>

          <li <?php echo ($menu_tab == "professeur") ? 'class="left_nav_active theme_border"' : ''; ?>> 
            <a href="javascript:void(0);"> 
              <i class="fa fa-tasks"></i> Professeurs <?php echo ($menu_tab == "professeur") ? '<span class="left_nav_pointer"></span>' : ''; ?><span class="plus"><i class="fa fa-plus"></i></span>
            </a>
            <ul <?php echo ($menu_tab == "professeur") ? 'class="opened" style="display:block"' : ''; ?>>
              <li> 
                <a href="creationProfesseur.controller.php"><i class="fa fa-circle<?php echo ($menu_tab_sub == "creationProfesseur") ? ' theme_color' : ''; ?>"></i> <b class="<?php echo ($menu_tab_sub == "creationProfesseur") ? ' theme_color' : ''; ?>">Création</b></a> 
              </li>
              <li> 
                <a href="listeProfesseur.controller.php"><i class="fa fa-circle<?php echo ($menu_tab_sub == "listeProfesseur") ? ' theme_color' : ''; ?>"></i> <b class="<?php echo ($menu_tab_sub == "listeProfesseur") ? ' theme_color' : ''; ?>">Listes</b></a> 
              </li>
            </ul>
          </li>

          <li <?php echo ($menu_tab == "filiere") ? 'class="left_nav_active theme_border"' : ''; ?>>
            <a href="javascript:void(0);">
              <i class="fa fa-bookmark"></i> Filières <?php echo ($menu_tab == "filiere") ? '<span class="left_nav_pointer"></span>' : ''; ?><span class="plus"><i class="fa fa-plus"></i></span>
            </a>
            <ul <?php echo ($menu_tab == "filiere") ? 'class="opened" style="display:block"' : ''; ?>>
              <li>
                <a href="creationFiliere.controller.php"><i class="fa fa-circle<?php echo ($menu_tab_sub == "creationFiliere") ? ' theme_color' : ''; ?>"></i> <b class="<?php echo ($menu_tab_sub == "creationFiliere") ? ' theme_color' : ''; ?>">Création</b></a>
              </li>
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
                <a href="creationModule.controller.php"><i class="fa fa-circle<?php echo ($menu_tab_sub == "creationModule") ? ' theme_color' : ''; ?>"></i> <b class="<?php echo ($menu_tab_sub == "creationModule") ? ' theme_color' : ''; ?>">Création</b></a> 
              </li>
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
                <a href="calendarExamen.controller.php"><i class="fa fa-circle<?php echo ($menu_tab_sub == "calendarExamen") ? ' theme_color' : ''; ?>"></i> <b class="<?php echo ($menu_tab_sub == "calendarExamen") ? ' theme_color' : ''; ?>">Calendrier</b></a> 
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
                <a href="newMessageProfesseur.controller.php"><i class="fa fa-circle<?php echo ($menu_tab_sub == "newMessageProfesseur") ? ' theme_color' : ''; ?>"></i> <b class="<?php echo ($menu_tab_sub == "newMessageProfesseur") ? ' theme_color' : ''; ?>">Professeur</b></a> 
              </li>
              <li>
                <a href="newMessageFiliere.controller.php"><i class="fa fa-circle<?php echo ($menu_tab_sub == "newMessageFiliere") ? ' theme_color' : ''; ?>"></i> <b class="<?php echo ($menu_tab_sub == "newMessageFiliere") ? ' theme_color' : ''; ?>">Filiere</b></a> 
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </div>