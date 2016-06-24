<ul class="header main-menu">
<?   foreach($menus as $menu) : 
?>
    <li>
    <?="<a href='".DS.$menu['Menu']['controller'].DS.$menu['Menu']['action']."'>".$menu['Menu']['name']."</a>"; ?>
    </li>
<? endforeach; ?>
</ul>