<?php
    class AdminDanhMuc{
        public $conn;

        public function __construct()
        {
            $this->conn = connectDB();
        }

        public function getAllDanhMuc(){
            try{
                $sql = 'SELECT * FROM danh_mucs';
                $stml = $this->conn->prepare($sql);
                $stml->execute();

                return $stml->fetchAll();
            }catch(Exception $e){
                echo "Lỗi" . $e->getMessage();
            }
        }

        public function insertDanhMuc($ten_danh_muc, $mo_ta){
            try{
                $sql = 'INSERT INTO danh_mucs(ten_danh_muc, mo_ta)
                        VALUES (:ten_danh_muc, :mo_ta)';

                $stml = $this->conn->prepare($sql);

                $stml->execute([
                    ':ten_danh_muc' => $ten_danh_muc,
                    ':mo_ta' => $mo_ta
                ]);

                return true;
            }catch(Exception $e){
                echo "Lỗi" . $e->getMessage();
            }
        }

        public function getDetailDanhMuc($id){
            try{
                $sql = 'SELECT * FROM danh_mucs WHERE id = :id';

                $stml = $this->conn->prepare($sql);

                $stml->execute([
                    ':id' => $id
                ]);

                return $stml->fetch();
            }catch(Exception $e){
                echo "Lỗi" . $e->getMessage();
            }
        }

        public function updateDanhMuc($id, $ten_danh_muc, $mo_ta){
            try{
                $sql = 'UPDATE danh_mucs SET ten_danh_muc = :ten_danh_muc, mo_ta = :mo_ta WHERE id = :id';

                $stml = $this->conn->prepare($sql);

                $stml->execute([
                    ':ten_danh_muc' => $ten_danh_muc,
                    ':mo_ta' => $mo_ta,
                    ':id' => $id
                ]);

                return true;
            }catch(Exception $e){
                echo "Lỗi" . $e->getMessage();
            }
        }

        public function destroyDanhMuc($id){
            try{
                $sql = 'DELETE FROM danh_mucs WHERE id = :id';

                $stml = $this->conn->prepare($sql);

                $stml->execute([
                    ':id' => $id
                ]);

                return true;
            }catch(Exception $e){
                echo "Lỗi" . $e->getMessage();
            }
        }
    }
?>