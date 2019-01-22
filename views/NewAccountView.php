<?php

class NewAccountView {
	protected $message = "";
	protected $scope_msg = "";

	protected $missing = array();
	public function setMessage($message, $scope) {
		$this->message = $message;
		$this->scope_msg = $scope;
	}

	public function setMissing($missing) {
		$this->missing = $missing;
	}

	protected function displayMissing() {
		$retour = "";
		foreach ($this->missing as $value) {
			$name = $value->getKey();
			$retour .= <<<EOF
			<script>
			document.getElementsByName('$name')[0].style.borderColor = 'red';
			</script>
EOF;
		}
		return $retour;
	}

	protected function displayMessage() {
		if($this->message != "") {
			return <<<EOF
			<div class="ui $this->scope_msg message">
			<p>$this->message</p>
			</div>
EOF;
		}
	}

	public function getHTML() {
		?>
		<div class="ui center aligned one column stackable page grid">
				<div class="column ten wide">
					<div class="ui raised segments">
						<div id="loginHeader" class="ui inverted blue top attached segment">
							<h3>Créer un nouvel utilisateur</h3>
						</div>
						<div id="loginDiv" class="ui bottom attached segment">
							<form class="ui form" method="POST">
								<input type="hidden" name="page" value="NewAccount">
								<input type="hidden" name="form"
								value="sent">
								<div class="field">
									<label>Nom d'utilisateur</label>
									<input name="username" placeholder="Nom d'utilisateur" type="text">
								</div>
								<div class="field">
									<label>Mot de passe</label>
									<input name="password" placeholder="Mot de passe" type="password">
								</div>
								<div class="field" style="text-align: left;">
									<div class="ui checkbox">
										<input name="role" type="checkbox">
										<label>Administrateur</label>
									</div>
								</div>
								<button class="ui button" type="submit">Valider</button>
							</form>
							<?=$this->displayMessage()?>
							<?=$this->displayMissing()?>
						</div>
					</div>

				</div>
		</div>
		<div class="ui container">
			

		</div>
		<?php
	}
}