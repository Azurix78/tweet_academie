<div class="contain-msgp" >
	<div class="list-msg">
	</div>
	<form method="post" class="astuce form-msg">
		<textarea row="20" cols="40" name="msg-content" id="msg-content"  maxlength="141" onKeyDown="nbcharTweet('msg-content','nb-caract', 'max-caract');" onKeyUp="nbcharTweet('msg-content','nb-caract', 'max-caract');" placeholder="Ecrire un message"></textarea>
		<b style="display:none;" id="max-caract">Nombre de caractères maximum atteint !</b><em id="nb-caract">140</em>
		<input type="submit" value="Envoyer" class="btn btn-info">
	</form>
</div>