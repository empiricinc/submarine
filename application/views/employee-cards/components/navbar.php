<section class="secnavMain">
  <nav class="navbar navbar-inverse" style="padding: 0px;">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span> 
        </button>
        <a class="navbar-brand" href="#"><img src="<?= base_url(); ?>assets/img/bars.png" alt=""></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="<?= base_url(); ?>">Home</a></li>
          <!-- <li class="dropdown">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                Reports <span class="fa fa-caret"></span>
              </a>
              <ul class="dropdown-menu"> -->
                <li class=""><a href="<?= base_url(); ?>Employee_cards/index">Dashboard</a></li>

                <li class=""><a href="<?= base_url(); ?>Employee_cards/received">Received Cards</a></li>

              <!-- </ul>
          </li> -->
          
          
          <li>
            <a href="#">
              <span class="dot"></span>
              <span class="dot"></span>
              <span class="dot"></span>
            </a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="#">
              <img src="<?= base_url(); ?>assets/img/profile.png" alt="">
              Hasseb Khattak
              <span class="caret"></span>    
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</section>