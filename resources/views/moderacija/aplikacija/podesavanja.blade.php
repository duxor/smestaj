@extends('moderacija.master-moderator')

<div class="container">
	<div class="row">
		 <form class="form-horizontal">
            <fieldset>
                <!-- Address form -->
         
                <h2>Podešavanja</h2>
         
                <!-- Izbor teme-->
                <div class="control-group">
                    <label class="control-label">Izbor teme</label>
                    <div class="controls">
                        <select id="country" name="country" class="input-xlarge">
                            <option value="" selected="selected">(Izaberite temu)</option>
                            <option value="AF">Afghanistan</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Naziv Brenda:</label>
                    <div class="controls">
                        <input id="full-name" name="full-name" type="text" placeholder="Unesite naziv brenda"
                        class="input-xlarge">
                        <p class="help-block"></p>
                    </div>
                </div>
              <div class="control-group">
                    <label class="control-label">Saradnja:</label>
                    <div class="controls">
                        <select id="country" name="country" class="input-xlarge">
                            <option value="" selected="selected">(Da li ste za saradnju)</option>
                            <option value="1">Da</option>
                            <option value="0">Ne</option>
                        </select>
                    </div>
                </div>
   
                

            </fieldset>
        </form>
	</div>
</div>

