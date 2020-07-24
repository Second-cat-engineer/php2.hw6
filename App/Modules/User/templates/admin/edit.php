<h1> Редактирование Пользователя </h1>

<form action="/admin/user/save" method="post">
    <?php echo $this->user->login; ?>
    <select name="operation">
        <option>user</option>
        <option>admin</option>
    </select>
    <button type="submit" name="id" value="<?php echo $this->user->getId(); ?>">
        Сохранить
    </button>
</form>

