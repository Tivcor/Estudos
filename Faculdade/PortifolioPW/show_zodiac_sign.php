<div class="container mt-5 texto-centralizado">
    <?php
    foreach ($signos->signo as $signo) {
        $data_inicio = DateTime::createFromFormat('d/m', (string)$signo->dataInicio);
        $data_fim = DateTime::createFromFormat('d/m', (string)$signo->dataFim);
        
        // Ajustar o ano das datas para o ano da data de nascimento
        $data_inicio->setDate($data_nascimento->format('Y'), $data_inicio->format('m'), $data_inicio->format('d'));
        $data_fim->setDate($data_nascimento->format('Y'), $data_fim->format('m'), $data_fim->format('d'));
        
        // Caso o intervalo cruze o ano
        if ($data_inicio > $data_fim) {
            $data_fim->modify('+1 year');
            
            if ($data_nascimento < $data_inicio && $data_nascimento > $data_fim) {
                continue;
            }
        }
        
        // Verificar se a data de nascimento está no intervalo do signo
        if ($data_nascimento >= $data_inicio && $data_nascimento <= $data_fim) {
            echo "<h2 style='color: white;'>{$signo->signoNome}</h2>";
            echo "<p style='color: white;'>{$signo->descricao}</p>";
            $signo_encontrado = true;
            break;
        }
    }

    if (!$signo_encontrado) {
        echo "<p style='color: white;'>Não foi possível determinar seu signo. Verifique a data informada.</p>";
    }
    ?>
    <a href="index.php" class="btn" style="background-color: #007bff; color: white; border-radius: 25px; width: auto;">
        Voltar
    </a>
</div>
