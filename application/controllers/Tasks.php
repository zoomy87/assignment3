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


    
    
    // your new methods go here
    
    
    
    public function delete($project_id, $task_id)
    {
        $this->task_model->delete_task($task_id);
        $this->session->set_flashdata('task_deleted', 'Your task has been deleted');
        redirect("projects/display/" .$project_id ." ");
    }

    public function mark_complete($task_id)
    {
        if ($this->task_model->mark_task_complete($task_id)) {
            $project_id = $this->task_model->get_task_project_id($task_id);
            $this->session->set_flashdata('mark_done', 'This is task has been completed');
            redirect('projects/display/' . $project_id . '');
        }
    }

    public function mark_incomplete($task_id)
    {
        if ($this->task_model->mark_task_incomplete($task_id)) {
            $project_id = $this->task_model->get_task_project_id($task_id);
            $this->session->set_flashdata('mark_undone', 'This is task has been Marked Undone');
            redirect('projects/display/' . $project_id . '');
        }
    }
}
