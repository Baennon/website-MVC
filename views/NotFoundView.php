<?php
class NotFoundView {
	protected $page;

	function __construct($page) {
		$this->page = $page;
	}

	public function getHTML() {
		?>

		<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>404</h1>
			</div>
			<h2>Oops! La page '<?=$this->page?>' est introuvable</h2>
			<p>Désolé mais la page que vous recherchez est introuvable, a été supprimée, renommée ou est temporairement inaccessible</p>
			<a href="?">Retourner à l'acceuil</a>
		</div>
	</div>
		<?php
	}
}