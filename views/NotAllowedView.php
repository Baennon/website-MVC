<?php
class NotAllowedView {
	protected $page;

	function __construct($page) {
		$this->page = $page;
	}

	public function getHTML() {
		?>
		<style type="text/css">
			body {
					background-image: url("/img/bg.jpg");
					background-size: 100%;
					background-attachment: fixed;
			}
		</style>
		<div class="ui one column stackable page grid">
			<div class="column sixteen wide">
				<div class="ui negative message">
					<div class="header">
						Vous n'avez pas l'autorisation d'acceder à la page '<?=$this->page?>'!
					</div>
					<p>Connectez-vous pour y accéder</p>
				</div>
				<br>
				<center>
				<div class="ui compact raised segments">
					<div id="loginHeader" class="ui inverted blue top attached segment">
						<h3>Connexion</h3>
					</div>
					<div id="loginDiv" class="ui bottom attached segment">
						<form action="?page=<?=$this->page?>" method="POST" id="loginForm" class="ui form">
							<input type="hidden" name="action" value="connect">
							<label for="username">Nom d'utilisateur</label>
							<input type="text" name="username" id="username">
							<label for="username">Mot de passe</label>
							<input type="password" name="password" id="password"><br><br>
							<input class="ui button" type="submit" value="Connexion">
						</form>
					</div>
				</div>
				</center>
			</div>
		</div>
		<?php
	}
}