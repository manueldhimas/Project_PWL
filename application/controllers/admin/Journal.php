<?php

class Journal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
		$this->load->model('auth_model');
		if (!$this->auth_model->current_user()) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data['current_user'] = $this->auth_model->current_user();
		$data['articles'] = $this->article_model->get();
		if (count($data['articles']) <= 0) {
			$this->load->view('admin/journal_empty.php', $data);
		} else {
			$this->load->view('admin/journal_list.php', $data);
		}
	}

	public function new()
	{
		$data['current_user'] = $this->auth_model->current_user();
		$this->load->library('form_validation');
		if ($this->input->method() === 'post') {
			$rules = $this->article_model->rules();
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() === FALSE) {
				return $this->load->view('admin/journal_new_form.php', $data);
			}

			// generate unique id and slug
			$id = uniqid('', true);
			$slug = url_title($this->input->post('title'), 'dash', TRUE) . '-' . $id;

			$article = [
				'id' => $id,
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'content' => $this->input->post('content'),
				'draft' => $this->input->post('draft')
			];

			$saved = $this->article_model->insert($article);

			if ($saved) {
				$this->session->set_flashdata('message', 'Article was created');
				return redirect('admin/journal');
			}
		}

		$this->load->view('admin/journal_new_form.php', $data);
	}

	public function edit($id = null)
	{
		$data['current_user'] = $this->auth_model->current_user();
		$this->load->library('form_validation');
		$data['article'] = $this->article_model->find($id);

		if (!$data['article'] || !$id) {
			show_404();
		}

		if ($this->input->method() === 'post') {

			$rules = $this->article_model->rules();
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() === FALSE) {
				return $this->load->view('admin/journal_edit_form.php', $data);
			}

			$article = [
				'id' => $id,
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'draft' => $this->input->post('draft')
			];
			$updated = $this->article_model->update($article);
			if ($updated) {
				$this->session->set_flashdata('message', 'Article was updated');
				redirect('admin/journal');
			}
		}

		$this->load->view('admin/journal_edit_form.php', $data);
	}

	public function delete($id = null)
	{
		if (!$id) {
			show_404();
		}

		$deleted = $this->article_model->delete($id);
		if ($deleted) {
			$this->session->set_flashdata('message', 'Article was deleted');
			redirect('admin/journal');
		}
	}
}
?>