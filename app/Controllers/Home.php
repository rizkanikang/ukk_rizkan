<?php

namespace App\Controllers;

use App\Models\M_model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Intervention\Image\ImageManagerStatic as Image;

class Home extends BaseController
{
    public function index()
    {
        echo view('header');
        echo view('login');
        echo view('footer');
    }
    public function dashboard()
    {
        $model = new M_model();
        $data['totalUsers'] = $model->getTotalUsers();
        echo view('header');
        echo view('menu');
        echo view('dashboard', $data);
        echo view('footer');
    }
    public function gantipassword()
    {

        $model = new M_model();
        $data['murid'] = $model->tampil('user');
        echo view('header');
        echo view('menu');
        echo view('change_password', $data);
        echo view('footer');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/Home');
    }
    public function aksi_changepassword()
    {
        $model = new M_model();
        $id = $this->request->getPost('id');
        $password = $this->request->getPost('password');
        $where = array('id_user' => session()->get('id'));
        $data1 = array(
            'password' => md5($password),
            'updated_at' => date('Y-m-d H:i:s')
        );
        // print_r($password);
        $model->qedit('user', $data1, $where);
        return redirect()->to('/home/index/');
    }
    public function aksi_login()
    {
        $u = $this->request->getPost('username');
        $p = $this->request->getPost('password');
        $model = new M_model();
        $data = array(
            'username' => $u,
            'password' => md5($p)
        );
        $cek = $model->getWhere2('user', $data);

        if ($cek > 0) {
            session()->set('id', $cek['id_user']);
            session()->set('username', $cek['username']);
            session()->set('email', $cek['email']);
            session()->set('level', $cek['level']);
            return redirect()->to('/home/dashboard');
        } else {
            // Tambahkan kode berikut
            session()->setFlashdata('error', 'Salah password');
            return redirect()->to('/home/index');
        }
    }
    public function user()
    {
        $model = new M_model();
        $on = 'user.level=level.id_level';

        $data['vuser'] = $model->join2('user', 'level', $on);

        echo view('header');
        echo view('menu');
        echo view('tabel_user', $data);
        echo view('footer');
    }
    public function buku()
    {
        // if (session()->get('level') == 1) {
        $model = new M_model();
        $on = 'book.kategori=kategori.id_kategori';
        $data['a'] = $model->join2('book', 'kategori', $on);
        echo view('header');
        echo view('menu');
        echo view('tabel_buku', $data);
        echo view('footer');
    }
    public function detail_buku($id)
    {
        // if (session()->get('level') == 1) {
        $model = new M_model();
        $data['title'] = 'Detail Buku';
        $data['book'] = $model->getBookById($id);
        echo view('header');
        echo view('menu');
        echo view('detail_buku', $data);
        echo view('footer');
    }
    public function aksi_tambahbuku()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $Model = new M_model();
            $data = $this->request->getPost();
            $photo = $this->request->getFile('cover');
            $Model->insertt($data, $photo);
            return redirect()->to('/home/buku/');
        } else {
            return redirect()->to('Login');
        }
    }

    public function tambahbuku()
    {

        $model = new M_model();
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $data['a'] = $model->tampil('kategori');
        } else {
            return redirect()->to('Login');
        }
        $data['title'] = 'Tambah Buku';
        echo view('header');
        echo view('menu');
        echo view('add_buku', $data);
        echo view('footer');
    }
    public function kategori()
    {
        //    if(session()->get('level')== 1) {
        $model = new M_model();
        $data['vstaf'] = $model->tampil('kategori');
        // $data['title'] = 'Data Kategori';

        echo view('header');
        echo view('menu');
        echo view('tabel_kategori', $data);
        echo view('footer');
        // }else {
        //     return redirect()->to('login');
        // }
    }
    public function tambahkategori()
    {

        $model = new M_model();
        if (session()->get('level') == 1) {


            $data['title'] = 'Tambah Kategori';
            echo view('header');
            echo view('menu');
            echo view('add_kategori', $data);
            echo view('footer');
        }

    }
    public function editkategori($id)
    {

        $model = new M_model();
        $where = array('id_kategori' => $id);
        $data['a'] = $model->getWhere('kategori', $where);
        // $data['title'] = 'Data Kategori';
        echo view('header');
        echo view('menu');
        echo view('edit_kategori', $data);
        echo view('footer');

    }
    public function aksi_editkategori()
    {
        $id = $this->request->getPost('id');  // Terima nilai $id dari formulir

        // Dapatkan nilai nama_k dari formulir
        $nama_k = $this->request->getPost('nama_k');

        // Tentukan kondisi WHERE
        $where = ['id_kategori' => $id];

        // Data yang akan diupdate
        $data = ['nama_k' => $nama_k];

        // Panggil model untuk melakukan pembaruan
        $model = new M_model();
        $model->qedit('kategori', $data, $where);

        // Redirect ke halaman kategori setelah pembaruan
        return redirect()->to('/home/kategori');
    }
    public function deletekategori($id)
    {
        if (session()->get('level') == 1) {
            $model = new M_model();
            $where = array('id_kategori' => $id);
            $model->hapus('kategori', $where);
            return redirect()->to('/home/kategori');
        } else {
            return redirect()->to('login');
        }
    }
    public function deletepeminjaman($id)
    {
        if (session()->get('level') == 1) {
            $model = new M_model();
            $where = array('id_peminjaman' => $id);
            $model->hapus('peminjaman', $where);
            return redirect()->to('/home/peminjaman');
        } else {
            return redirect()->to('login');
        }
    }
    public function peminjaman()
    {
        if (session()->get('level') == 1) {
            $model = new M_model();
            $on = 'peminjaman.id_book = book.id_book';
            $on2 = 'peminjaman.id_user = user.id_user';
            $data['vstaf'] = $model->join3('peminjaman', 'book', 'user', $on, $on2);

            // $data['title'] = 'Data Peminjaman';

            echo view('header');
            echo view('menu');
            echo view('tabel_peminjaman', $data);
            echo view('footer');
        } else {
            return redirect()->to('login');
        }
    }
    public function aksipinjam($id_peminjaman)
    {
        $model = new M_model();
        $peminjaman = $model->getpeminjamanById($id_peminjaman);
        $newStatus = ($peminjaman->status === 'Dipinjam') ? 'Dikembalikan' : 'Dipinjam';
        $data = array('status' => $newStatus);
        $where = array('id_peminjaman' => $id_peminjaman);
        $model->qedit('peminjaman', $data, $where);
        return redirect()->to('/home/peminjaman');
    }
    public function hapuspeminjaman($id)
    {
        if (session()->get('level') == 1) {
            $model = new M_model();
            $where = array('id_peminjaman' => $id);
            $model->hapus('peminjaman', $where);
            return redirect()->to('/home/peminjaman');
        } else {
            return redirect()->to('login');
        }
    }
    public function tambahpeminjaman()
    {
        if (session()->get('level') == 1) {
            $model = new M_model();
            $data['a'] = $model->tampil('user');
            $data['c'] = $model->tampil('book');
            echo view('header');
            echo view('menu');
            echo view('add_peminjaman', $data);
            echo view('footer');
        } else {
            return redirect()->to('login');
        }
    }

    public function aksi_addpeminjaman()
    {
        if (session()->get('level') == 1) {
            $a = $this->request->getPost('user');
            $b = $this->request->getPost('book');
            $c = $this->request->getPost('tgl_kembali');
            $d = $this->request->getPost('jumlah');


            //Yang ditambah ke user
            $data1 = array(
                'id_user' => $a,
                'id_book' => $b,
                'tgl_kembali' => $c,
                'jumlah' => $d,
                'tgl_pinjam' => date('Y-m-d'),
                'status' => 'Dipinjam'
            );
            $model = new M_model();
            $model->simpan('peminjaman', $data1);

            return redirect()->to('/home/peminjaman');
        } else {
            return redirect()->to('login');
        }
    }
    public function aksi_addkategori()
    {
        if (session()->get('level') == 1) {
            $a = $this->request->getPost('nama_k');

            $data1 = array(
                'nama_k' => $a,
                'created_at' => date('Y-m-d H:i:s')
            );
            $model = new M_model();
            $model->simpan('kategori', $data1);

            return redirect()->to('/home/kategori');
        } else {
            return redirect()->to('login');
        }
    }
    public function reset($id)
    {
        $model = new M_model();
        $where = array('id_user' => $id);
        $user = array('password' => 'aaaa');
        $model->qedit('user', $user, $where);

        // Uncomment the following line to enable redirection
        return redirect()->to('/Home/user');
    }
    public function adduser()
    {
        $model = new M_model();

        $data['user'] = $model->tampil('user');
        echo view('header');
        echo view('menu');
        echo view('add_user', $data);
        echo view('footer');
    }
    public function aksi_adduser()
    {
        $model = new M_model();
        // $on='guru.user = user.id_user';
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $level = $this->request->getPost('level');

        $user = array(
            'username' => $username,
            'password' => md5('password'),
            'email' => $email,
            'level' => '3',
            'created_at' => date('Y-m-d H:i:s')
        );

        $model = new M_model();
        $model->simpan('user', $user);
        return redirect()->to('/home/user');
    }
    public function addstaf()
    {
        $model = new M_model();

        $data['user'] = $model->tampil('user');
        echo view('header');
        echo view('menu');
        echo view('add_staf', $data);
        echo view('footer');
    }
    public function aksi_addstaf()
    {
        $model = new M_model();
        // $on='guru.user = user.id_user';
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $alamat = $this->request->getPost('alamat');
        $tanggal_lahir = $this->request->getPost('tanggal_lahir');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        $no_tlp = $this->request->getPost('no_tlp');
        $level = $this->request->getPost('level');
        $created_by = $this->request->getPost('created_by');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');

        $user = array(
            'username' => $username,
            'password' => md5('password'),
            'email' => $email,
            'level' => '3',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('id')
        );

        $model = new M_model();
        $model->simpan('user', $user);

        $where = array('username' => $username);
        $id = $model->getWhere2('user', $where);
        $id_user = $id['id_user'];
        $staf = array(
            'user_id' => $id_user,
            'nama' => $nama,
            'alamat' => $alamat,
            'tanggal_lahir' => $tanggal_lahir,
            'tempat_lahir' => $tempat_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'no_tlp' => $no_tlp,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('id')
        );
        // print_r($siswa);
        $model->simpan('staf', $staf);
        return redirect()->to('/home/staf');
    }
    public function editsiswa($id)
    {
        // if (session()->get('level') == 1) {

        $model = new M_model();
        $on = 'siswa.user_id=user.id_user';
        $where = array(
            'user_id' => $id
        );
        $data['siswa'] = $model->joinW('siswa', 'user', $on, $where);
        echo view('header');
        echo view('menu');
        echo view('edit_siswa', $data);
        echo view('footer');


        // } else {
        //     return redirect()->to('/home/dashboard');
        // }
    }
    public function delete($id)
    {
        if (session()->get('level') == 1) {
            $Model = new M_Model();
            $Model->delete($id);
            return redirect()->to('/home/buku/');
        } else {
            return redirect()->to('Login');
        }
    }
    public function aksi_editsiswa()
    {
        $model = new M_model();
        // $on='guru.user = user.id_user';
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $tanggal_lahir = $this->request->getPost('tanggal_lahir');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        $no_tlp = $this->request->getPost('no_tlp');
        $level = $this->request->getPost('level');
        $created_by = $this->request->getPost('created_by');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $where2 = array('user_id' => $id);
        $data2 = array(
            'nama' => $nama,
            'alamat' => $alamat,
            'tanggal_lahir' => $tanggal_lahir,
            'tempat_lahir' => $tempat_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'no_tlp' => $no_tlp,
            'siswa_updated_at' => date('Y-m-d H:i:s')
        );
        //    print_r($id);
        // //  print_r($data2);
        $model->qedit('siswa', $data2, $where2);
        return redirect()->to('/home/siswa');
    }
    public function editbuku($id)
    {
        $userLevel = session()->get('level');

        if ($userLevel == 1) {
            $model = new M_model();
            $model2 = new M_model();
            $data['a'] = $model->getById($id); // Mendapatkan data pengguna berdasarkan $id

            if (!$data['a']) {
                return redirect()->to('/home/buku');
            }

            if ($userLevel == 1) {
                $data['kategori'] = $model2->tampil('kategori');
            }

            $data['title'] = 'Edit Buku';

            echo view('header');
            echo view('menu');
            echo view('edit_buku', $data);
            echo view('footer');
        } else {
            return redirect()->to('Login');
        }
    }
    public function update($id)
    {
        // if (session()->get('level') == 1 || session()->get('level') == 2) {
        $Model = new M_model();
        $data = $this->request->getPost();
        $photo = $this->request->getFile('cover');


        if ($photo->isValid() && !$photo->hasMoved()) {

            $Model->updateP($id, $data, $photo);
        } else {

            $Model->update($id, $data);
        }

        return redirect()->to('/home/buku');
        // } else {
        //     return redirect()->to('Login');
        // }
    }

    public function editstaf($id)
    {
        // if (session()->get('level') == 1) {

        $model = new M_model();
        $on = 'staf.user_id=user.id_user';
        $where = array(
            'user_id' => $id
        );
        $data['staf'] = $model->joinW('staf', 'user', $on, $where);
        echo view('header');
        echo view('menu');
        echo view('edit_staf', $data);
        echo view('footer');


        // } else {
        //     return redirect()->to('/home/dashboard');
        // }
    }
    public function aksi_editstaf()
    {
        $model = new M_model();
        // $on='guru.user = user.id_user';
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $tanggal_lahir = $this->request->getPost('tanggal_lahir');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        $no_tlp = $this->request->getPost('no_tlp');
        $level = $this->request->getPost('level');
        $created_by = $this->request->getPost('created_by');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $where2 = array('user_id' => $id);
        $data2 = array(
            'nama' => $nama,
            'alamat' => $alamat,
            'tanggal_lahir' => $tanggal_lahir,
            'tempat_lahir' => $tempat_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'no_tlp' => $no_tlp,
            'staf_updated_at' => date('Y-m-d H:i:s')
        );
        //    print_r($id);
        // //  print_r($data2);
        $model->qedit('staf', $data2, $where2);
        return redirect()->to('/home/siswa');
    }
    public function filterpeminjaman()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_model();
            $data['kunci'] = 'print_in';
            echo view('header');
            echo view('menu');
            echo view('filterpeminjaman', $data);
            echo view('footer');
        } else {
            return redirect()->to('/login');
        }
    }
    public function filterpengembalian()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_model();
            $data['kunci'] = 'print_in';
            echo view('header');
            echo view('menu');
            echo view('filterpengembalian', $data);
            echo view('footer');
        } else {
            return redirect()->to('/login');
        }
    }
    public function print_peminjaman()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_model();
            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');
            $status = "Dipinjam";
            $data['vstaf'] = $model->filter22('peminjaman', $awal, $akhir, $status);
            echo view('laporan', $data);
        } else {
            return redirect()->to('/login');
        }
    }
    public function pdf_peminjaman()
    {

        $model = new M_model();
        $awal = $this->request->getPost('awal');
        $akhir = $this->request->getPost('akhir');
        $status = "Dipinjam";
        $data['vstaf'] = $model->filter22('peminjaman', $awal, $akhir, $status);
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('laporan', $data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream('my.pdf', array('Attachment' => 0));

    }
    public function excel_peminjaman()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) {
            $model = new M_model();
            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');
            $status = "Dipinjam";

            $data = $model->filter22('peminjaman', $awal, $akhir, $status);


            $spreadsheet = new Spreadsheet();

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Nama Peminjam')
                ->setCellValue('B1', 'Nama Buku')
                ->setCellValue('C1', 'Tanggal Pinjam')
                ->setCellValue('D1', 'Tanggal Kembali')
                ->setCellValue('E1', 'Jumlah')
                ->setCellValue('F1', 'Status');
            $column = 2;


            foreach ($data as $data) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $column, $data->nama)
                    ->setCellValue('B' . $column, $data->nama_b)
                    ->setCellValue('C' . $column, $data->tgl_pinjam)
                    ->setCellValue('D' . $column, $data->tgl_kembali)
                    ->setCellValue('E' . $column, $data->jumlah)
                    ->setCellValue('F' . $column, $data->status);
                $column++;
            }


            $writer = new XLsx($spreadsheet);
            $fileName = 'Data Laporan Buku Dipinjam';


            header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition:attachment;filename=' . $fileName . '.xls');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        } else {
            return redirect()->to('/login');
        }
    }
    public function print_pengembalian()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_model();
            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');
            $status = "Dikembalikan";
            $data['vstaf'] = $model->filter222('peminjaman', $awal, $akhir, $status);
            echo view('laporan', $data);
        } else {
            return redirect()->to('/login');
        }
    }
    public function pdf_pengembalian()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) {
            $model = new M_model();
            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');
            $status = "Dikembalikan";
            $data['vstaf'] = $model->filter222('peminjaman', $awal, $akhir, $status);
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml(view('laporan', $data));
            $dompdf->setPaper('A4', 'potrait');
            $dompdf->render();
            $dompdf->stream('my.pdf', array('Attachment' => 0));
        } else {
            return redirect()->to('/login');
        }
    }
    public function excel_pengembalian()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) {
            $model = new M_model();
            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');
            $status = "Dikembalikan";

            $data = $model->filter222('peminjaman', $awal, $akhir, $status);


            $spreadsheet = new Spreadsheet();

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Nama Peminjam')
                ->setCellValue('B1', 'Nama Buku')
                ->setCellValue('C1', 'Tanggal Pinjam')
                ->setCellValue('D1', 'Tanggal Kembali')
                ->setCellValue('E1', 'Jumlah')
                ->setCellValue('F1', 'Status');
            $column = 2;


            foreach ($data as $data) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $column, $data->nama)
                    ->setCellValue('B' . $column, $data->nama_b)
                    ->setCellValue('C' . $column, $data->tgl_pinjam)
                    ->setCellValue('D' . $column, $data->tgl_kembali)
                    ->setCellValue('E' . $column, $data->jumlah)
                    ->setCellValue('F' . $column, $data->status);
                $column++;
            }


            $writer = new XLsx($spreadsheet);
            $fileName = 'Data Laporan Buku Dikembalikan';


            header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition:attachment;filename=' . $fileName . '.xls');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        } else {
            return redirect()->to('/login');
        }
    }
}