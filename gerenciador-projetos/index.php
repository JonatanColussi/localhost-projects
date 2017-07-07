<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Jonatan Colussi">
    <title>Gerenciador de projetos | Jonatan Colussi</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/tooltipster.bundle.min.css" rel="stylesheet">
    <link href="css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-shadow.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>
    <main class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title">Gerenciador de projetos | Jonatan Colussi</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group box-search">
                    <input type="search" name="filter" placeholder="Pesquisar" class="form-control" autofocus>
                </div>
            </div>
        </div>
        <div class="row projects">
            <?php
                foreach(glob('../*', GLOB_ONLYDIR) as $project){
                    $stat = stat($project);
                    $modified = date('d/m/Y', $stat['mtime']);
                    $subdirs = glob($project.'/{,.}*', GLOB_BRACE);
                
                    $hasGit = in_array($project.'/.git', $subdirs);
                    $hasSftp = in_array($project.'/sftp-config.json', $subdirs);

                    $nameProject = str_replace('../', null, $project);

                    if(strrpos($nameProject, '-') != false)
                        $name = explode('-', $nameProject);
                    elseif(strrpos($nameProject, '_') != false)
                        $name = explode('_', $nameProject);
                    else
                        $name = [$nameProject];

                    $name = array_map('ucfirst', $name);

                    $nameProject = implode(' ', $name);

                    $nameProject = trim($nameProject);
                    echo "<a href=\"{$project}\">
                                <div>";
                    if($hasGit) echo "<i class=\"fa fa-code-fork\" title=\"É um repositório Git\"></i>";
                    if($hasSftp) echo "<i class=\"fa fa-server\" title=\"Contém os dados de ftp\"></i>";
                    if(!$hasGit && !$hasSftp) echo "<i class=\"fa fa-folder\" title=\"É apenas um diretório\"></i>";
                            echo "</div>
                                <div>
                                    <span>{$nameProject}</span>
                                    <p>{$modified}</p>
                                </div>
                            </a>";
                }
            ?>
        </div>
    </main>

    <footer>
        <?= date('Y') ?> Jonatan Colussi
    </footer>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/tooltipster.bundle.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
  </body>
</html>
