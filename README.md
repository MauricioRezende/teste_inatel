Para execução do projeto estou utilizando Apache 2.4 e PHP 7.2 configurados no WampServer 3.1.

Dentro da pasta "conf", há um arquivo chamado "configuration.php", nele está configurado o acesso ao banco de dados, onde estou utilizando o servidor "localhost", usuário "root", senha em branco "" e nome do banco de dados "alcool_mais". Caso utilize configurações diferentes de conexão com banco de dados, basta alterar esse arquivo.

Dentro da pasta "sql", há um arquivo chamado "create.sql", onde, basta criar um banco de dados chamado "alcool_mais" (caso utilize outro nome, lembre-se de alterar o arquivo "configuration.php" citado acima) e executar o script salvo no arquivo ou importa-lo.

Há um usuário de administrador já criado na base de dados, utilize "01234567899" e "123456" como usuário e senha respectivamente para acessar.

O valor máximo para o cadastro do produto também está pré-definido como "10,00", podendo ser alterado dentro da área do administrador.

O teste foi desenvolvido por completo.

Fiquei com uma dúvida sobre a utilização de framework, por que utilizei uma mascara para alguns campos de alguns formulários de cadastro, a mascara é desenvolvida também em Jquery, apenas não está inclusa diretamente no pacote do Jquery.

Não vi problema por ser em Jquery, mas se não poderia ser utilizada, peço perdão, utilizei apenas o seguinte trecho, dentro do arquivo "scripts.js", localizado na pasta "js":

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

Sobre a prioridade para pessoas do grupo de risco, a validação é feita quando a pessoa coloca um ou mais produtos em seu carrinho de compra, ao efetuar a compra é verificado o risco do usuário e dos demais usuários que estão com o mesmo produto no carrinho.

A limitação de duas compras por CPF está sendo feita para compras no mesmo dia e também em dias diferentes, como por exemplo uma compra a 5 dias atrás e outra compra hoje.

Se o usuário não realizar nenhuma ação dentro de 3 horas sua sessão é encerrada.

Se um usuário tentar acessar uma página exclusiva de outro perfil sua sessão é encerrada.

Para os cadastros inicais de cliente e estabelcimento o preenchimento dos campos estão sendo validandos tando no front-end quanto no back-end.

O usuário de perfil administrador pode:
-Alterar sua senha;
-Aprovar ou não o cadastro de um estabelecimento;
-Aprovar ou não o cadatro de um produto;
-Visualizar os clientes cadastrados;
-Configurar o preço máximo de um produto;
-Cadastrar, editar e excluir (apenas se nenhum usuário estiver usando) riscos.

O usuário de perfil estabelecimento pode:
-Alterar sua senha;
-Cadastrar, editar e excluir (apenas se nenhum usuário tiver comprado) produtos;
-Alterar o status de um produto comprado (Aguardando envio, Produto enviado e Produto entregue).

O usuário de perfil cliente pode:
-Dizer (sim ou não) se possui algum risco (previamente cadastrado pelo administrador);
-Alterar sua senha;
-Pesquisar produtos por cidade e estado e adicionar o mesmo em seu carrinho de compra;
-Efetuar a compra (após passado por todas as verificações);
-Visualizar suas compras e acompanhar a entrega das mesmas.

Agradeço pela oportunidade de desenvolvimento do projeto.