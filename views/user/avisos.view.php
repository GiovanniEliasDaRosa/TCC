<?php foreach ($avisos as $aviso) : ?>
  <div>
    <span><?= $aviso['titulo'] ?></span>
    <span><?= htmlspecialchars($aviso['corpo']) ?></span>
    <span><?= $aviso['dt_inicio'] ?></span>
    <span><?= $aviso['dt_fim'] ?></span>
    <button>Ler Mais</button>
  </div>
<?php endforeach; ?>