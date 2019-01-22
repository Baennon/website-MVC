<?php
foreach(glob("utils/*.php") as $file){
    require_once($file);
}

foreach(glob("models/*.php") as $file){
    require_once($file);
}

foreach(glob("models/DBO/*.php") as $file){
    require_once($file);
}

foreach(glob("views/*.php") as $file){
    require_once($file);
}

foreach(glob("controllers/*.php") as $file){
    require_once($file);
}
