DB::beginTransaction();
                try {
                    
                    DB::statement("ALTER TABLE ".( new \App\Models\UserManagement\UxuiUsers )->table." AUTO_INCREMENT = 1");
                    $password=Hash::make($password);

                    $model =(new \App\Models\UserManagement\UxuiUsers);
                    $model->username=$id_user;
                    $model->password=DB::raw("AES_ENCRYPT('".$password."','jiwana')");
                    
                    if($model->save()){
                        DB::commit();
                    }else{
                        DB::rollBack();    
                    }                    
                } catch (\Illuminate\Database\QueryException $e) {
                    dd($e);
                    DB::rollBack();
                } catch (\Throwable $e) {
                    dd($e);
                    DB::rollBack();
                }