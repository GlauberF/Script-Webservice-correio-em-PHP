<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
    $(function() {        
        $('button#btnCep').click(function() {
            $.ajax({
                type: "GET",
                url: "verifycep.php?cep="+$('input#cep').val(),
                dataType: "json",
                success: function(response) {
                    //$("#responsecontainer").html(response);
                    if(!response[0].bairro){
                        $('img#visualizadorcep').css("display", "inline");
                        $('img#visualizadorcep').attr("src", 'img/notok.png');
                        var r = "<div class=\"alert alert-danger\"><strong>Este CEP não existe!</strong> Por favor, tente outro.</div>";   
                        $("#returncep").append(r);
                        $("input#bairro").val('').attr('readonly', false);
                        $("input#endereco").val('').attr('readonly', false);
                        $("input#cidade").val('').attr('readonly', false);                    
                        $("input#uf").val('').attr('readonly', false);                        
                    }else{    
                        $('img#visualizadorcep').attr("src", 'img/ok.png');                        
                        $('img#visualizadorcep').css("display", "inline");
                        $("#returncep").find('div').remove();                         
                        $("input#bairro").val(response[0].bairro).attr('readonly', true);
                        $("input#endereco").val(response[0].endereco).attr('readonly', true);
                        $("input#cidade").val(response[0].cidade).attr('readonly', true);                    
                        $("input#uf").val(response[0].uf).attr('readonly', true);
                    }
                }
            });            
        });                
    });     
</script>    
</head>
<body>
<div class="container-fluid">
  <div class="row">
	  <div class="col-md-6">
	  	<form>
            <div class="span6">
                <div class="span4">
                    <label>CEP</label>
                    <div class="input-append">
                        <input class="input-large" id="cep" name="cep" type="text">
                        <button class="btn" id="btnCep" type="button">Procurar</button><img id="visualizadorcep" style="display: none; padding-left: 10px;" src="" />
                    </div>                                    
                    <div id="returncep"></div>                    
                </div>    
            </div>                       
            <div class="span6">
                <div class="span4">
                    <label>Endereço</label>
                    <div class="input-append">
                        <input name="endereco" size="30" id="endereco" type="text" placeholder="" autocomplete="off"><input name="numero" size="4" id="numero" type="text" placeholder="Nº" autocomplete="off">
                    </div>                                    
                </div>    
            </div>
            <div class="span6">
                <div class="span4">
                    <label>Bairro</label>
                    <div class="input-append">
                        <input name="bairro" id="bairro" type="text" placeholder="" autocomplete="off">
                    </div>                                    
                </div>    
            </div>
            <div class="span6">
                <div class="span4">
                    <label>Cidade</label>
                    <div class="input-append">
                        <input name="cidade" id="cidade" type="text" placeholder="" autocomplete="off"><input size="4" name="uf" id="uf" type="text" placeholder="UF" autocomplete="off">
                    </div>                                    
                </div>    
            </div>        	  	
	  	</form>
	  </div>
  </div>
</div>
</body>
</html>