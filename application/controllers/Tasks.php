<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller
{
    public function display($task_id)
    {
        $data['project_id'] = $this->task_model->get_task_project_id($task_id);
        $data['project_name'] = $this->task_model->get_project_name($data['project_id']);

        $data['task'] = $this->task_model->get_task($task_id);
        $data['main_view'] = "tasks/display";
        $this->load->view('layouts/main', $data);
    }

    public function create($projectId)
    {
        $this->form_validation->set_rules('task_name', 'task Name', 'trim|required');
        $this->form_validation->set_rules('task_body', 'task Description', 'trim|required');
        $this->form_validation->set_rules('due_date', 'due date', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['main_view'] = 'tasks/create_task';
            $this->load->view('layouts/main', $data);
        } else {
            $data = array(
                'project_id' => $projectId,
                'task_name' => $this->input->post('task_name'),
                'task_body' => $this->input->post('task_body'),
                'due_date' => $this->input->post('due_date')
                );

            if ($this->task_model->create_task($data)) {
                $this->session->set_flashdata('Task_created', 'Your task has been created');

                redirect("project/display/");
            }
        }
    }


    
    
    // your new methods go here
    
	
}
