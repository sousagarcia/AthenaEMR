<?php
    class ClinicModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/clinic_view"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('clinic');
            $query = $this->db->get();
            return $query->result();
        }

        public function generate_id(){
            $result = $this->db->count_all('clinic');

            if($result<=9){
                $query = "DIV-000" . $result;
            } else if($result<=99){
                $query = "DIV-00" . $result;
            } else if($result<=999){
                $query = "DIV-0" . $result;
            } else if($result<=9999){
                $query = "DIV-" . $result;
            }

            return $query;
        }

        public function create_clinic($clinic_id, $name, 
				$tariff) {
		
		$data = array(
			'clinic_id'   => $clinic_id,
			'name'   => $name,
			'tariff'      => $tariff,
			'created_at' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('clinic', $data);
		
	}

        public function Insert($data){
            $this->db->insert('clinic', $data);
        }

        public function Read_specific($NIS){
            $this->db->select('*');
            $this->db->from('clinic');
            $this->db->where('clinic_id', $NIS);
            return $this->db->get();
        }

        public function Update($clinic_id, $name, 
				$tariff){
            
            $data = array(
                'clinic_id'   => $clinic_id,
			    'name'   => $name,
			    'tariff'      => $tariff,
                'updated_at' => date('Y-m-j H:i:s'),
		    );

            $this->db->where("clinic_id", $clinic_id);
            $this->db->update("clinic",$data);
            $this->Redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('clinic');
	    }
        
        
    }
?>