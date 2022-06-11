<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use CodeIgniter\HTTP\RequestInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MahasiswaController extends BaseController
{
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $mahasiswa = $this->mahasiswaModel->getMahasiswa();

        $data = [
            'title' => 'Data Curriculum Vitae Mahasiswa',
            'mahasiswa' => $mahasiswa,
        ];

        return view("super_admin/mahasiswa/index", $data);
    }

    public function create()
    {
        return view("super_admin/mahasiswa/create");
    }

    public function store()
    {
        if (!$this->validate([
            'image' => [
                'rules' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,5120]',
                'errors' => [
                    'uploaded' => 'There must be a file uploaded',
                    'mime_in' => 'File Extension Must Be jpg,jpeg,gif,png',
                    'max_size' => 'File Size Max 5 MB'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $dataImage = $this->request->getFile('image');
        $fileName = $dataImage->getRandomName();


        $this->mahasiswaModel->insert([
            'photo' => $fileName,
            'nama' => $this->request->getPost('nama'),
            'profesi' => $this->request->getPost('profesi'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'telephone' => $this->request->getPost('telephone'),
            'aboutme' => $this->request->getPost('aboutme'),
            'namasekolah' => $this->request->getPost('namasekolah'),
            'pendidikan' => $this->request->getPost('pendidikan'),
            'jurusan' => $this->request->getPost('jurusan'),
            'pengalaman' => $this->request->getPost('pengalaman'),
            'Jabatan' => $this->request->getPost('Jabatan'),
        ]);

        $dataImage->move('uploads/images/', $fileName);

        return redirect('super_admin/mahasiswa')->with('success', 'Data CV Added Successfully');
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        if (!$this->validate([
            'image' => [
                'rules' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,100]',
                'errors' => [
                    'uploaded' => 'There must be a file uploaded',
                    'mime_in' => 'File Extension Must Be jpg,jpeg,gif,png',
                    'max_size' => 'File Size Max 5 MB'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $dataImage = $this->request->getFile('image');
        $fileName = $dataImage->getRandomName();

        $this->mahasiswaModel->update($id, [
            'photo' => $fileName,
            'nama' => $this->request->getPost('nama'),
            'profesi' => $this->request->getPost('profesi'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'telephone' => $this->request->getPost('telephone'),
            'aboutme' => $this->request->getPost('aboutme'),
            'namasekolah' => $this->request->getPost('namasekolah'),
            'pendidikan' => $this->request->getPost('pendidikan'),
            'jurusan' => $this->request->getPost('jurusan'),
            'pengalaman' => $this->request->getPost('pengalaman'),
            'Jabatan' => $this->request->getPost('Jabatan')
        ]);

        $dataImage->move('uploads/images/', $fileName);

        return redirect('super_admin/mahasiswa')->with('success', 'CV Update Successfully');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        $this->mahasiswaModel->delete($id);

        return redirect('super_admin/mahasiswa')->with('success', 'Data Deleted Successfully');
    }

    public function viewpdf()
    {
        $data = $this->db->table("mahasiswa")->get()->getResult();
        return view('filepdf', [
            "mahasiswas" => $data
        ]);
    }

    public function exportpdf()
    {
        $dompdf = new Dompdf();

        $mahasiswa = $this->mahasiswaModel->getMahasiswa();

        foreach ($mahasiswa as $key => $dataMahasiswa) {
            $path = 'uploads/images/' . $dataMahasiswa['photo'];
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $mahasiswa[$key]['photo'] = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        $dompdf->loadHtml(view('pdf/data-cv', ['mahasiswas' => $mahasiswa]));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('CV_Mahasiswa', array("Attachment" => false));

        return redirect()->to(base_url('filepdf'));
    }

    public function exportexcel()
    {
        $mahasiswa = $this->mahasiswaModel->getMahasiswa();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Photo');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Profesi');
        $sheet->setCellValue('D1', 'Alamat');
        $sheet->setCellValue('E1', 'Email');
        $sheet->setCellValue('F1', 'Telephone');
        $sheet->setCellValue('G1', 'About Me');
        $sheet->setCellValue('H1', 'Asal Universitas/Sekolah');
        $sheet->setCellValue('I1', 'Pendidikan');
        $sheet->setCellValue('J1', 'Jurusan');
        $sheet->setCellValue('K1', 'Pengalaman');
        $sheet->setCellValue('L1', 'Jabatan');
        $rows = 2;

        foreach ($mahasiswa as $val) {
            $sheet->setCellValue('A' . $rows, $val['photo']);
            $sheet->setCellValue('B' . $rows, $val['nama']);
            $sheet->setCellValue('C' . $rows, $val['profesi']);
            $sheet->setCellValue('D' . $rows, $val['alamat']);
            $sheet->setCellValue('E' . $rows, $val['email']);
            $sheet->setCellValue('F' . $rows, $val['telephone']);
            $sheet->setCellValue('G' . $rows, $val['aboutme']);
            $sheet->setCellValue('H' . $rows, $val['namasekolah']);
            $sheet->setCellValue('I' . $rows, $val['pendidikan']);
            $sheet->setCellValue('J' . $rows, $val['jurusan']);
            $sheet->setCellValue('K' . $rows, $val['pengalaman']);
            $sheet->setCellValue('L' . $rows, $val['Jabatan']);
            $rows++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Curriculum Vitae Mahasiswa';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
