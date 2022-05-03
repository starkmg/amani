<?php
global $session;
ob_start();
?>
    <nav class="bottom-navbar" style="background: -#27293d;">
        <div class="container">
            <ul class="nav page-navigation">
                <li class="nav-item">
                    <a class="nav-link" href="home">
                        <i class="ti-home menu-icon"></i>
                        <span class="menu-title"><?=MENU_HOME;?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="widgets">
                        <i class="ti-settings menu-icon"></i>
                        <span class="menu-title"><?=MENU_PARAMETERS;?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="ti-package menu-icon"></i>
                        <span class="menu-title"><?=MENU_APPS;?></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item"><a class="nav-link" href="email"><?=SUB_MENU_EMAIL?></a></li>
                            <li class="nav-item"><a class="nav-link" href="calendar"><?=SUB_MENU_CALENDAR?></a></li>
                            <li class="nav-item"><a class="nav-link" href="todo"><?=SUB_MENU_TODOLIST?></a></li>
                        </ul>
                    </div>
                </li>
                <!--sli class="nav-item dropdown me-1">
                    <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown"
                       href="#" data-bs-toggle="dropdown">
                        <i class="ti-email menu-icon"></i>
                        <span class="menu-title"><?=MENU_MESSAGES;?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                        <p class="mb-0 font-weight-normal float-left dropdown-header"><?=SUB_MENU_MESSAGES;?></p>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="https://via.placeholder.com/36x36" alt="image" class="profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow">
                                <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                                </h6>
                                <p class="font-weight-light small-text text-muted mb-0">
                                    The meeting is cancelled
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="https://via.placeholder.com/36x36" alt="image" class="profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow">
                                <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                                </h6>
                                <p class="font-weight-light small-text text-muted mb-0">
                                    New product launch
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="https://via.placeholder.com/36x36" alt="image" class="profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow">
                                <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                                </h6>
                                <p class="font-weight-light small-text text-muted mb-0">
                                    Upcoming board meeting
                                </p>
                            </div>
                        </a>
                    </div>
                </li-->
                <!--li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                        <i class="ti-bell menu-icon"></i>
                        <span class="count"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                        <p class="mb-0 font-weight-normal float-left dropdown-header"><?=MENU_NOTIFICATIONS;?></p>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                    <i class="ti-info-alt mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                <p class="font-weight-light small-text mb-0 text-muted">
                                    Just now
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-warning">
                                    <i class="ti-settings mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal">Settings</h6>
                                <p class="font-weight-light small-text mb-0 text-muted">
                                    Private message
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-info">
                                    <i class="ti-user mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                <p class="font-weight-light small-text mb-0 text-muted">
                                    2 days ago
                                </p>
                            </div>
                        </a>
                    </div>
                </li-->
                <li class="nav-item">
                    <a href="documentation" class="nav-link">
                        <i class="ti-receipt menu-icon"></i>
                        <span class="menu-title"><?=MENU_DOCUMENTATION?></span></a>
                </li>
            </ul>
        </div>
    </nav>
<?php
$menu = ob_get_clean();
?>