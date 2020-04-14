Para execu��o do projeto estou utilizando Apache 2.4 e PHP 7.2 configurados no WampServer 3.1.

Dentro da pasta "conf", h� um arquivo chamado "configuration.php", nele est� configurado o acesso ao banco de dados, onde estou utilizando o servidor "localhost", usu�rio "root", senha em branco "" e nome do banco de dados "alcool_mais". Caso utilize configura��es diferentes de conex�o com banco de dados, basta alterar esse arquivo.

Dentro da pasta "sql", h� um arquivo chamado "create.sql", onde, basta criar um banco de dados chamado "alcool_mais" (caso utilize outro nome, lembre-se de alterar o arquivo "configuration.php" citado acima) e executar o script salvo no arquivo ou importa-lo.

H� um usu�rio de administrador j� criado na base de dados, utilize "01234567899" e "123456" como usu�rio e senha respectivamente para acessar.

O valor m�ximo para o cadastro do produto tamb�m est� pr�-definido como "10,00", podendo ser alterado dentro da �rea do administrador.

O teste foi desenvolvido por completo.

Fiquei com uma d�vida sobre a utiliza��o de framework, por que utilizei uma mascara para alguns campos de alguns formul�rios de cadastro, a mascara � desenvolvida tamb�m em Jquery, apenas n�o est� inclusa diretamente no pacote do Jquery.

N�o vi problema por ser em Jquery, mas se n�o poderia ser utilizada, pe�o perd�o, utilizei apenas o seguinte trecho, dentro do arquivo "scripts.js", localizado na pasta "js":

var cpf = $("#cpf")
cpf.mask('000.000.000-00', {reverse: true})

var celular = $("#celular")		        
celular.mask('00 0 0000-0000',{reverse: true})

var cpf = $("#cnpj")
cpf.mask('00.000.000/0000-00', {reverse: true})

var telefone = $("#telefone")		        
telefone.mask('00 0000-0000',{reverse: true})

var preco = $("#preco")
preco.mask('000,00', {reverse: true})

Sobre a prioridade para pessoas do grupo de risco, a valida��o � feita quando a pessoa coloca um ou mais produtos em seu carrinho de compra, ao efetuar a compra � verificado o risco do usu�rio e dos demais usu�rios que est�o com o mesmo produto no carrinho.

A limita��o de duas compras por CPF est� sendo feita para compras no mesmo dia e tamb�m em dias diferentes, como por exemplo uma compra a 5 dias atr�s e outra compra hoje.

Se o usu�rio n�o realizar nenhuma a��o dentro de 3 horas sua sess�o � encerrada.

Se um usu�rio tentar acessar uma p�gina exclusiva de outro perfil sua sess�o � encerrada.

Para os cadastros inicais de cliente e estabelcimento o preenchimento dos campos est�o sendo validandos tando no front-end quanto no back-end.

O usu�rio de perfil administrador pode:
-Alterar sua senha;
-Aprovar ou n�o o cadastro de um estabelecimento;
-Aprovar ou n�o o cadatro de um produto;
-Visualizar os clientes cadastrados;
-Configurar o pre�o m�ximo de um produto;
-Cadastrar, editar e excluir (apenas se nenhum usu�rio estiver usando) riscos.

O usu�rio de perfil estabelecimento pode:
-Alterar sua senha;
-Cadastrar, editar e excluir (apenas se nenhum usu�rio tiver comprado) produtos;
-Alterar o status de um produto comprado (Aguardando envio, Produto enviado e Produto entregue).

O usu�rio de perfil cliente pode:
-Dizer (sim ou n�o) se possui algum risco (previamente cadastrado pelo administrador);
-Alterar sua senha;
-Pesquisar produtos por cidade e estado e adicionar o mesmo em seu carrinho de compra;
-Efetuar a compra (ap�s passado por todas as verifica��es);
-Visualizar suas compras e acompanhar a entrega das mesmas.

Agrade�o pela oportunidade de desenvolvimento do projeto.