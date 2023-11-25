
    <datalist id="evek">
        <?php foreach ($viewData['evek'] as $ev): ?>
            <option value="<?= $ev ?>"></option>
        <?php endforeach; ?>
    </datalist>

    <datalist id="honapok">
        <?php foreach ($viewData['honapok'] as $honap): ?>
            <option value="<?= $honap ?>"></option>
        <?php endforeach; ?>
    </datalist>

<form id="szuro" onsubmit="event.preventDefault();">
    <select id="szolgid" name="szolgid">
        <?php foreach ($viewData['szolgaltatasok'] as $szolg): ?>
            <option value="<?= $szolg['id'] ?>"><?= $szolg['jelentes'] ?></option>
        <?php endforeach; ?>
    </select>
    <div id="date">
        <input type="number" id="ev" name="ev" min="<?= min($viewData['evek']) ?>" max="<?= max($viewData['evek']) ?>" list="evek" required>
        <input type="number" id="honap" name="honap" min="<?= min($viewData['honapok']) ?>" max="<?= max($viewData['honapok']) ?>" list="honapok" required>
        <button type="submit" id="gomb">Szűrés</button>
        <a id="pdf-link" href="" target="_blank">PDF letöltése</a>
    </div>
</form>

<div id="eredmeny">
    <div id="naptar"></div>
    <div class="canvas-wrapper">
        <canvas id="grafikon"></canvas>
    </div>    
</div>

<script>
    const SITE_ROOT = "<?= SITE_ROOT ?>";
    const IMAGES_ROOT = "<?= SITE_ROOT . 'images/' ?>";
    const AJAX_URL = "<?= SITE_ROOT . 'ajax/' ?>";
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
