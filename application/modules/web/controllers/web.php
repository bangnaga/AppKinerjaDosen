<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class web extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 

	function index()
	{
		$d['menu'] = $this->app_global_web->generate_index_menu();
		$d['last_update'] = $this->app_global_forum->generate_index_last_update($GLOBALS['site_limit_small']);
		$d['banner_berita'] = $this->app_global_web->generate_banner_berita(2);
		$d['home_berita'] = $this->app_global_web->generate_home_berita(3,2);
		$d['banner_gallery'] = $this->app_global_web->generate_banner_gallery();
		
 		$this->load->view($GLOBALS['site_theme']."/front/bg_header",$d);
 		$this->load->view($GLOBALS['site_theme']."/front/bg_banner");
 		$this->load->view($GLOBALS['site_theme']."/front/bg_left");
 		$this->load->view($GLOBALS['site_theme']."/front/bg_home");
 		$this->load->view($GLOBALS['site_theme']."/front/bg_footer");
	}
 

	function pages($id_param=0)
	{
		$where['id_menu'] = $id_param;
		$get_data = $this->db->get_where("dlmbg_menu",$where);
		$d['banner_gallery'] = $this->app_global_web->generate_banner_gallery();
		$d['banner_berita'] = $this->app_global_web->generate_banner_berita(2);
		if($get_data->num_rows()>0)
		{
			$h = $get_data->row();
			if($h->url_route=="")
			{
				$d['judul'] = $h->menu;
				$d['content'] = $h->content;
				
				$d['menu_atas'] = $this->app_global_web->generate_index_menu("atas");
				$d['menu_bawah'] = $this->app_global_web->generate_index_menu("bawah");
				$this->load->view($GLOBALS['site_theme']."/front/bg_header",$d);
				$this->load->view($GLOBALS['site_theme']."/front/bg_pages");
				$this->load->view($GLOBALS['site_theme']."/front/bg_footer");
			}
      		else
      		{
				redirect($h->url_route);
      		}
		}
		else
		{
			redirect(base_url());
		}
	}
}
