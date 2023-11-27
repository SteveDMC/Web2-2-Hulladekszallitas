<div>
    <h2>REST kliens</h2>
    <form action="<?= SITE_ROOT ?>rest_kliens" method="post">
        <label for="id">ID:</label><input type="number" name="id" min="0"><br>
        <label for="tipus">Típus:</label><input type="text" name="tipus"><br>
        <label for="jelentes">Jelentés:</label><input type="text" name="jelentes"><br>
        <label for="method">Metódus:</label>
        <select name="method">
            <option value="GET">GET</option>
            <option value="POST">POST</option>
            <option value="PUT">PUT</option>
            <option value="DELETE">DELETE</option>
        </select>
        <input type="hidden" name="send" value="1"/>
        <input type="submit" value="Küldés">
    </form>
</div>

<p>
    <?php if (isset($viewData["response_code"])): ?>
        HTTP válaszkód: <b><?= $viewData["response_code"] ?></b>
    <?php endif; ?>
</p>

<div>
    <?php if (isset($viewData["result"]) && !empty($viewData["result"])): ?>
        <table>
            <thead>
                <tr>
                    <th colspan="3">Válasz adatok</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Típus</th>
                    <th>Jelentés</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($viewData["result"] as $res): ?>
                    <tr>
                        <td><?= $res["id"] ?></td>
                        <td><?= $res["jelentes"] ?></td>
                        <td><?= $res["tipus"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
