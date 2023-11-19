<?php

class Regisztral_Model
{
	public function get_data($vars)
	{
		extract($vars);
        $retData['eredmeny'] = "";
		try {
			$connection = Database::getConnection();
            $stmt = $connection->prepare("select count(*) as count from felhasznalok where bejelentkezes = ?");
            $stmt->execute([$login]);
            @[$result] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result['count'] > 0) {
                throw new LogicException("A '$login' felhasználónév már foglalt!");
            }
            if ($password !== $pw_confirm) {
                throw new LogicException("A jelszavak nem egyeznek!");
            }
            $connection->prepare("insert into felhasznalok (csaladi_nev, utonev, bejelentkezes, jelszo, jogosultsag) values (?, ?, ?, ?, ?)")->execute([
                $csaladi_nev, $utonev, $login, sha1($password), '_1_',
            ]);
            $retData['uzenet'] = "Kedves $login, a regisztráció sikeresen megtörtént!";
		} catch (Throwable $e) {
            $retData['eredmeny'] = "ERROR";
            $retData['uzenet'] = $e->getMessage();
        }
		return $retData;
	}
}
