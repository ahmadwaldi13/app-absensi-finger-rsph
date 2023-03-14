<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\UserManagement\UxuiAuthRoutes;
use App\Models\UserManagement\UxuiAuthGroup;
use App\Models\UserManagement\UxuiAuthPermission;
use App\Models\UserManagement\UxuiAuthUsers;
use App\Services\UserManagement\UserAksesAppService;

use App\User;
use App\Models\UxuiUsers;
use App\Models\UserAdmin;

use App\Classes\ListRoutes;

class UxuiUserAksesSeeder extends Seeder
{

	public function __construct(
		UserAksesAppService $userAksesAppService
	) {
		$this->userAksesAppService = $userAksesAppService;
	}
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		try {      
			$check=UxuiAuthRoutes::count();
			if($check==0){
				DB::statement('SET FOREIGN_KEY_CHECKS=0;');
				$db=UxuiAuthRoutes::truncate();
				DB::statement('SET FOREIGN_KEY_CHECKS=1;');

				$list_routes=(new ListRoutes)->getDataAuth();
				if(!empty($list_routes)){
					foreach($list_routes as $key_list => $value_list){
						if(!empty($value_list['item'])){
							$item=$value_list['item'];
							
							foreach($item as $key => $value){
								$value=(object)$value;
								if(!empty($value->method)){
									$data_save=[
										'title'=>trim($value_list['title']),
										'url'=>trim($value->url),
										'controller'=>trim($value->controller),
										'type'=>trim($value->type),
									];

									UxuiAuthRoutes::create($data_save);
								}
							}
						}
					}
				}
			}
			
			$check=UxuiAuthGroup::count();
			if($check==0){
				DB::statement('SET FOREIGN_KEY_CHECKS=0;');
				$db=UxuiAuthGroup::truncate();
				DB::statement('SET FOREIGN_KEY_CHECKS=1;');

				UxuiAuthGroup::create(['name' => 'Super Admin','alias'=>'group_super_admin']);
				UxuiAuthGroup::create(['name' => 'Admin','alias'=>'group_admin']);
				UxuiAuthGroup::create(['name' => 'Dokter','alias'=>'group_dokter']);
				UxuiAuthGroup::create(['name' => 'Perawat','alias'=>'group_perawat']);
				UxuiAuthGroup::create(['name' => 'Petugas','alias'=>'group_petugas']);
			}

			$check=UxuiAuthPermission::count();
			if($check==0){
				DB::statement('SET FOREIGN_KEY_CHECKS=0;');
				$db=UxuiAuthPermission::truncate();
				DB::statement('SET FOREIGN_KEY_CHECKS=1;');

				$list_routes=UxuiAuthRoutes::select('url')->get();
				if(!empty($list_routes)){
					$get_group=UxuiAuthGroup::select('alias')->whereIn('alias', ['group_super_admin'])->get();
					if(!empty($get_group)){
						
						foreach($get_group as $value_g){
							$alias=$value_g->alias;
							foreach($list_routes as $list){
								$data_save=[
									'alias_group'=>trim($alias),
									'url'=>trim($list->url),
								];

								UxuiAuthPermission::insertOrIgnore($data_save);
							}
						}

					}
				}
			}

			$check=UxuiAuthUsers::count();
			if($check==0){
				DB::statement('SET FOREIGN_KEY_CHECKS=0;');
				$db=UxuiAuthUsers::truncate();
				DB::statement('SET FOREIGN_KEY_CHECKS=1;');

				$data_user=$this->userAksesAppService->getList([]);
				if(!empty($data_user)){
					foreach($data_user as $value){
						$status=!empty($value->status) ? $value->status : null;
						if($status=='petugas'){
							$alis_group='group_petugas';
						}elseif($status=='dokter'){
							$alis_group='group_dokter';
						}else{
							$alis_group='';
						}

						$data_save=[
							'id'=>$value->id_user_,
							'id_user'=>$value->id_user,
							'alias_group'=>$alis_group,
						];

						UxuiAuthUsers::insertOrIgnore($data_save);
					}
				}
			}

			$user_admin=UserAdmin::select('usere as id_user',DB::raw("AES_DECRYPT(usere,'nur') as index_user "))->get();
			if(!empty($user_admin)){
				foreach($user_admin as $value){
					$data_save=[
						'id'=>$value->index_user,
						'id_user'=>$value->id_user,
						'alias_group'=>'group_super_admin'
					];
					UxuiAuthUsers::insertOrIgnore($data_save);
				}            
			}
		} catch(\Illuminate\Database\QueryException $e){
			if($e->errorInfo[1] == '1062'){
				dd($e);
			}
			dd($e);
		} catch (\Throwable $e) {
			dd($e);
		}
	}
}