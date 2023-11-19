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
    <input type="number" id="ev" name="ev" min="<?= min($viewData['evek']) ?>" max="<?= max($viewData['evek']) ?>" list="evek" required>
    <input type="number" id="honap" name="honap" min="<?= min($viewData['honapok']) ?>" max="<?= max($viewData['honapok']) ?>" list="honapok" required>
    <button type="submit">Lekérdez</button>
</form>

<div>
    <table id="naptar"></table>
</div>

<script>
    const AJAX_URL = '<?= SITE_ROOT . 'ajax/' ?>';
</script>