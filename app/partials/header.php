  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <a class="navbar-brand" href="home.php">
      <i class="fas fa-store-alt"></i> Ecomm
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navbar-nav" class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <?php if(!isset($_SESSION['user']) || (isset($_SESSION['user'])) && ($_SESSION['user']['roles_id']==2)) {?>
        <li class="nav-item">
          <a class="nav-link <?php echo ($thisPage == "home") ? "active" : '' ?>" href="home.php"> HOME </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="catalog.php"> Catalog </a>
        </li>
      
        <li class="nav-item">
          <a class="nav-link" href="../views/cart.php"> Cart <span class="badge bg-success text-light" id="cart-count">
            <?php 
              if(isset($_SESSION['cart'])){
                echo array_sum($_SESSION['cart']);
              }else{
                echo 0;
              }

             ?>
          </span> </a>
           <li class="nav-item drop-down">
          <a class="nav-link <?php echo ($thisPage == "user") ? "active" : '' ?>" href="../views/profile.php">Profile</a>
        </li>
        </li>
      <?php }elseif (isset($_SESSION['user']) && (isset($_SESSION['user']['roles_id'])==1)){ ?>
        <li class="nav-item <?php echo ($thisPage == "items") ? "active" : '' ?>">
          <a class="nav-link" href="../views/items.php">Items</a>
        </li>
        <li class="nav-item drop-down">
          <a class="nav-link <?php echo ($thisPage == "user") ? "active" : '' ?>" href="../views/profile.php">Profile</a>
        </li>
        <li class="nav-item drop-down">
          <a class="nav-link <?php echo ($thisPage == "user") ? "active" : '' ?>" href="../views/users.php">Users</a>
        </li>
        <li class="nav-item drop-down">
          <a class="nav-link <?php echo ($thisPage == "user") ? "active" : '' ?>" href="../views/orders.php">Orders</a>
        </li>
      <?php } ?>
        <div class="dropdown show">
        <?php if(isset($_SESSION['user'])){?>     
         <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Welcome, <?php echo $_SESSION['user']['firstname'] ?>
    </button>
      <div class="dropdown-menu text-center col-12" aria-labelledby="dropdownMenuButton" >
          <a class="drodown-item" href="../controllers/log_out.php"> Logout </a>
          <hr>
          <a class="drodown-item" href="./register.php"> Register </a>
      </div>
      </div>
      <?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" href="../views/login.php"> Login </a>
        </li>
        <li class="nav-item">
        </li>
      <?php } ?>
      </ul>
    </div> <!-- end navbar nav -->
  </nav> <!-- end nav -->