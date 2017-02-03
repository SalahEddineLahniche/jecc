<div class="dash container">
    <div class="users">
        <p>Users</p>
        <?php foreach ($users as $user):?>
        <div class="user" data-id="<?= $user['id']?>" data-activated="<?= $user['activated']?>">
            <p class="name"><?= $user['name']?></p>
            <p class="role"><?= $user['role']?></p>
            <button class="activate btn btn-<?= $user['activated'] ? 'danger' : 'success'?>"><?= $user['activated'] ? 'Deactivate' : 'Activate now'?></button>
        </div>
        <?php endforeach;?>
    </div>
    <aside id="default-popup" class="avgrund-popup">
        <h2>Error</h2>
        <p>Problem occured while activating user ! please try again later.</p>
        <button onclick="javascript:closeDialog();" class='btn btn-primary'>Close</button>
    </aside>
    <div class="avgrund-cover"></div>
</div>