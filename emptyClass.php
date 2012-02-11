<?php


namespace Contoh\Aplikasi\Biodata;
/*
 *  Untuk View
 */
class BiodataView {

    function indexView($data) {
        echo "<table>
                    <tr>
                        <thead>
                        <th>Nama</th>
                        <th>Kad Pengenalan</th>
                        <th>Umur</th>
                        </thead>
                    </tr>
                    <tr>
                        <tbody>
                            <td>" . $data[0] . "</td>
                            <td>" . $data[1] . "</td>
                            <td>" . $data[2] . "</td>       
                        </tbody>
                   </tr>     
                </table>";
    }

}
/*
 *  untuk Controll output
 */
class BiodataController {

    public $page;
    public $model;
    public $view;

    function router($page) {
        $this->page = $page;
        if ($this->page == 'biodata') {
            $nama = $_GET['nama'];
            $kadPengenalan = $_GET['nama'];
            $umur = $_GET['umur'];
            $this->model = new \Contoh\Aplikasi\Biodata\BiodataModel();
            $this->model->setNama($nama);
            $this->model->setKadPengenalan($kadPengenalan);
            $this->model->setUmur($umur);
            $this->view = new \Contoh\Aplikasi\Biodata\BiodataView();
            $data = array($this->model->getNama(), $this->model->getKadPengenalan(), $this->model->getUmur());
            $this->view->indexView($data);
        } else if ($this->page =='Aweks'){
            
        } else if ($this->page =='Cartoons'){
            
        }
    }

}
/*
 *  Untuk  data dictonary
 */
class BiodataModel {

    private $nama;
    private $kadPengenalan;
    private $umur;

    public function getNama() {
        return $this->nama;
    }

    public function setNama($nama) {
        $this->nama = $nama;
    }

    public function getKadPengenalan() {
        return $this->kadPengenalan;
    }

    public function setKadPengenalan($kadPengenalan) {
        $this->kadPengenalan = $kadPengenalan;
    }

    public function getUmur() {
        return $this->umur;
    }

    public function setUmur($umur) {
        $this->umur = $umur;
    }

}

// untuk execute page
$application = new \Contoh\Aplikasi\Biodata\BiodataController();
$application->page('Biodata'); // ada orang pakai id dan novatis pakai object id untuk reference 
?>
