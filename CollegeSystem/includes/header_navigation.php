<nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3" style="background-color: #0066ff;">
      <div class="container">
        <a class="navbar-brand" href="#">College System</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
                    <li class="nav-item">
              <a class="nav-link text-white" href="about.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="about.php">About</a>
            </li>

        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="mx-auto"></div>
          <ul class="navbar-nav">
            <?php if(isset($_SESSION['user_id'])){ ?>
            <li class="nav-item">
                <a href="<?=$_SESSION['role_redirect']?>" class="nav-link"><?php echo "Hello, " . $_SESSION['firstname'] . " " . $_SESSION['surname'] . "!"; ?></a>
            </li>

            
            <li class="nav-item">
              <div class="nav_right">
            <ul>
                <li class="nr_li dd_main">
                    <img src="img/profile_pic.png" alt="Profile">
                    
                    <div class="dd_menu">
                        <div class="dd_right">
                            <ul>
                                <li >View</li>
                                <li>Edit</li>
                                <li><a href="logout.php">Log out</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                    <li class="nr_li">
                        <i class="fas fa-envelope-open-text"></i>
                    </li>
                </ul>
            </div>
            </li>
            <?php }
        else { ?>
            <li class="nav-item">
                <a href="index.php" class="nav-link">Login</a>
            </li>
            <li class="nav-item">
                <a href="register.php" class="nav-link">Register</a>
            </li>
        <?php } ?>
          </ul>
        </div>
      </div>
    </nav>

    <script>
    var dd_main = document.querySelector(".dd_main");

    dd_main.addEventListener("click", function(){
        this.classList.toggle("active");
    })
</script>
    