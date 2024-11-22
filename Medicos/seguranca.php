<?php
$showModal = false; // Variável para controlar se o modal será mostrado

$sql = "SELECT * FROM Medicos WHERE id_medico = '" . $_SESSION['id_medico'] . "'";
$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Aqui verificamos se o CRM é igual à senha (conforme sua lógica)
        if (md5($row['crm']) == $row['senha']) {  // Comparando CRM com a senha
            $showModal = true;  // Defina como true para exibir o modal
        }
    }

    // Exibe o modal se a condição for atendida
    if ($showModal) {
?>
        <!-- Pop-up Modal -->
        <div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Você não está seguro</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Altere a sua senha imediatamente! A senha deve ser diferente do seu CRM.
                    </div>
                    <div class="modal-footer">
                        <a href="senha.php" class="btn btn-primary">Mudar Senha</a>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "Erro na consulta: " . $conn->error;
}
?>