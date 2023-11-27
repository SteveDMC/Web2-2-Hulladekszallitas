<div class="rest">
    <h2>REST kliens külső szolgáltatáshoz (<a href="https://gorest.co.in/" target="_blank">https://gorest.co.in/</a>)</h2>
    <form action="<?= SITE_ROOT ?>admin_rest_kliens_kulso" method="post">
        <label for="id">ID:</label><input type="number" name="id" min="0"><br>
        <label for="name">Name:</label><input type="text" name="name"><br>
        <label for="email">Email:</label><input type="email" name="email"><br>
        <label for="gender">Gender:</label>
        <select name="gender">
            <option value="male">male</option>
            <option value="female">female</option>
        </select><br>
        <label for="status">Status:</label>
        <select name="status">
            <option value="active">active</option>
            <option value="inactive">inactive</option>
        </select><br>
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
<div class="http">
<p>
    <?php if (isset($viewData["response_code"])): ?>
        HTTP válaszkód: <b><?= $viewData["response_code"] ?></b>
    <?php endif; ?>
</p>
</div>
<div class="eredmeny">
    <?php if (isset($viewData["result"]) && !empty($viewData["result"])): ?>
        <table>
            <thead>
                <tr>
                    <th colspan="3">Válasz adatok</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($viewData["result"] as $res): ?>
                    <tr>
                        <td><?= $res["id"] ?></td>
                        <td><?= $res["name"] ?></td>
                        <td><?= $res["email"] ?></td>
                        <td><?= $res["gender"] ?></td>
                        <td><?= $res["status"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
