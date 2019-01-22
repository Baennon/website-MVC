<?php
class Headerview {
	protected static $name = "Mon site";
	protected $message = null;

	protected function getMenuItems() {
		$pages = array();
		foreach (glob('controllers/*.php') as $file) {
        	$class = basename($file, '.php');
        	if (class_exists($class)) {
            	if($class::getLabel() != null) {
            		if ($class::getMaxRole() == 0) {
            			if (UserModel::isConnected()) {
            				if (UserModel::getConnectedUser()->getValues()['role'] == "0") {
            					array_push($pages, array("link"=>$class::getLink(), "label"=>$class::getLabel(), "admin"=>1));
            				}
            			}
            		} else {
            			array_push($pages, array("link"=>$class::getLink(), "label"=>$class::getLabel(), "admin"=>0));
            		}	
            	}
           	
        	}
   	 	}	
   	 	return $pages;
	}

	public function setMessage($message) {
		$this->message = $message;
	}

	protected function getMessageStr() {
		if ($this->message != null) {
			return "<span class='item'>".$this->message."</span>";
		}
		return "";
	}

	protected function getLoginStr() {
		$loginStr = "";
		if(UserModel::isConnected()) {
			$username = UserModel::getConnectedUser()->getValues()["username"];
			$loginStr = <<<EOF
				<span class="item">Bienvenue $username</span>
				<form id="disconnect" class="ui form item" method="POST" style="background-color:red;margin:0;cursor:pointer;"><input type="hidden" name="action" value="disconnect"><span>Se déconnecter</span></form>
EOF;
		} else {
			$loginStr = <<<EOF
				<form class="ui mini form item" style="margin-bottom: 0;padding-bottom: 5px;padding-top: 5px;" method="POST">
					<input type="hidden" name="action" value="connect">
					<input type="text" placeholder="Username" name="username">
					<input type="password" placeholder="Password" name="password">
					<input type="submit" class="ui green button" value="Connexion">
				</form>
EOF;
		}
		return $loginStr;
	}

	public function getHTML() {
		?>
		<head>
			<title><?=static::$name?></title>
			<script type="text/javascript" src="js/jquery.min.js"></script>
			<script type="text/javascript" src="css/semantic/semantic.min.js"></script>
			<script type="text/javascript" src="js/Header.js"></script>
			<link rel="icon" type="image/png" href="img/favicon.png">
			<link href='css/main.css' type='text/css' rel='stylesheet'>
			<link rel="stylesheet" type="text/css" href="css/semantic/semantic.min.css">
		</head>
		<body>
		<div class="ui blue inverted big menu" style="border-radius: 0px;">
			<a class="header item" href="/">
				<?=static::$name?>
			</a>
			<?php
			foreach ($this->getMenuItems() as $value) {
				if($value['admin']==0) {
					$link = $value["link"];
					$label = $value["label"];
					echo <<<EOF
					<a class="item" href="?page=$link">$label</a>
EOF;
				}
			}
			?>  
			<div class="right menu">
			<?php
			foreach ($this->getMenuItems() as $value) {
				if($value['admin']==1) {
					$link = $value["link"];
					$label = $value["label"];
					echo <<<EOF
					<a class="item" href="?page=$link">$label</a>
EOF;
				}
			}
			?> 
				<?=$this->getMessageStr()?>
				<?=$this->getLoginStr()?>
			</div>
		</div>
		<?php
	}
}