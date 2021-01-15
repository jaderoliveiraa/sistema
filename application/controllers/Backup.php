<?php

class Backup extends CI_Controller {

    public function backup_syscontrol() {
        // Carrega a classe DB Utility 
        $this->load->dbutil();

// Executa o backup do banco de dados armazenado-o em uma variável
        $backup = $this->dbutil->backup();

// Carrega o helper File e cria um arquivo com o conteúdo do backup
        $this->load->helper('file');
        $data = date('d-m-Y');
        write_file('/path/Backup_SysControl (  Dia - '.$data.' ) .zip', $backup);

// Carrega o helper Download e força o download do arquivo que foi criado com 'write_file'
        $this->load->helper('download');
        force_download('Backup_SysControl (  Dia - '.$data.' ) .zip', $backup);
    }

}
