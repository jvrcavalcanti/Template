<main id="app">
    Não clica em min
    <div class="alert alert-danger">Sla</div>
    <?php
    $alert = $this->getComponent("alert");
    $alert->setType("danger");
    $alert->render();
    ?>
</main>