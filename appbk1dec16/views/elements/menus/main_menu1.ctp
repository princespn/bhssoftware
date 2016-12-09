<!-- Navigation Start -->
<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
      	<span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="index.html" class="navbar-brand"><img style="width:200px;" src="images/hs-logo.svg" alt=""></a> </div>
    <div class="navbar-collapse collapse" id="navbar">
      <ul class="nav navbar-nav">
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Master Listing <span class="caret"></span></a>
          <ul class="dropdown-menu">
               <li><?php echo $this->Html->link(__('Master Listing', true), array('controller' => 'stocks', 'action' => 'index/?page=1')); ?></li>
                <li><?php echo $this->Html->link(__('Website Prices', true), array('controller' => 'listings', 'action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__('Amazon Prices', true), array('controller' => 'main_listings', 'action' => 'index')); ?></li>
            </ul>
        </li>
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Product Code <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="product-listings.html">UK Product Code</a></li>
            <li><a href="#">FR Product Code</a></li>
            <li><a href="#">DE Product Code</a></li>
          </ul>
        </li>
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Master UK Listing <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#" data-toggle="modal" data-target="#myModal">Import Master UK Listing</a></li>
            <li><a href="#">Update Master UK Listing</a></li>
          </ul>
        </li>
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Amazon UK Listing <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Import Amazon UK Listing</a></li>
            <li><a href="#">Update Amazon UK Listing</a></li>
          </ul>
        </li>
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Master FR Listing <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Import Master FR Listing</a></li>
            <li><a href="#">Update Master FR Listing</a></li>
          </ul>
        </li>
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Amazon FR Listing <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Import Amazon FR Listing</a></li>
            <li><a href="#">Update Amazon FR Listing</a></li>
          </ul>
        </li>
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Master DE Listing <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Import Master DE Listing</a></li>
            <li><a href="#">Update Master DE Listing</a></li>
          </ul>
        </li>
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Amazon DE Listing <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Import Amazon DE Listing</a></li>
            <li><a href="#">Update Amazon DE Listing</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#">My Account <b class="caret"></b></a> <span class="dropdown-arrow dropdown-arrow-inverse"></span>
          <ul class="dropdown-menu dropdown-inverse">
            <li><a href="users.html">Users</a></li>
            <li class="divider"></li>
            <li><a href="#" data-toggle="modal" data-target="#addNewuser">Add New User</a></li>
            <li class="divider"></li>
            <li><a href="login.html">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- / Navigation Start -->