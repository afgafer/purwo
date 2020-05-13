<?php

use Illuminate\Database\Seeder;

class AnggotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            ['id'=>4,'name'=>'Afgafer','contact' =>'082223010181','address' =>'Kab Bantul, Bintang','users_id'=>1],
            ['id'=>5,'name'=>'BBintang','contact' =>'082223010181','address' =>'Kab Bantul, Bintang','users_id'=>2],
            ['id'=>6,'name'=>'PKukup','contact' =>'082223010182','address' =>'Kab G Kidul, Kukup','users_id'=>3],
            ]);
            DB::table('admins')->insert([
                ['id'=>1,'name'=>'Afgafer','contact' =>'082223010181','address' =>'Kab Bantul, Bintang','users_id'=>1,'dests_id'=>1],
                ['id'=>2,'name'=>'BBintang','contact' =>'082223010181','address' =>'Kab Bantul, Bintang','users_id'=>2,'dests_id'=>1],
                ['id'=>3,'name'=>'PKukup','contact' =>'082223010182','address' =>'Kab G Kidul, Kukup','users_id'=>3,'dests_id'=>1],
                ]);
                DB::table('dests')->insert([
                    ['id'=>1,'name'=>'BBintang','contact' =>'082223010181','address' =>'Kab Bantul, Bintang'],
                    ]);
                    DB::table('rooms')->insert([
                        ['id'=>1,'name'=>'Merah1','image' =>'merah1.jpg','price' =>100000,'quota' =>1,'bed' =>1,'description' =>'0','admins_id'=>1],
                        ['id'=>2,'name'=>'Merah2','image' =>'merah2.jpg','price' =>20000,'quota' =>2,'bed' =>2,'description' =>'0','admins_id'=>1],
                        ['id'=>3,'name'=>'Jingga1','image' =>'jingga1.jpg','price' =>100000,'quota' =>1,'bed' =>1,'description' =>'0','admins_id'=>1],
                        ['id'=>4,'name'=>'Jingga2','image' =>'jingga2.jpg','price' =>200000,'quota' =>2,'bed' =>2,'description' =>'0','admins_id'=>1],
                        ['id'=>5,'name'=>'Kuning','image' =>'kuning.jpg','price' =>200000,'quota' =>1,'bed' =>1,'description'=>'0','admins_id'=>1],
            
                        ['id'=>6,'name'=>'Merah2_1','image' =>'merah1.jpg','price' =>100000,'quota' =>1,'bed' =>1,'description' =>'0','admins_id'=>2],
                        ['id'=>7,'name'=>'Merah2_2','image' =>'merah2.jpg','price' =>20000,'quota' =>2,'bed' =>2,'description' =>'0','admins_id'=>2],
                        ['id'=>8,'name'=>'Jingga2_1','image' =>'jingga1.jpg','price' =>100000,'quota' =>1,'bed' =>1,'description' =>'0','admins_id'=>2],
                        ['id'=>9,'name'=>'Jingga2_2','image' =>'jingga2.jpg','price' =>200000,'quota' =>2,'bed' =>2,'description' =>'0','admins_id'=>2],
                        ['id'=>10,'name'=>'Kuning2','image' =>'kuning.jpg','price' =>200000,'quota' =>1,'bed' =>1,'description'=>'0','admins_id'=>2],
            
                        ['id'=>11,'name'=>'Merah3_1','image' =>'merah1.jpg','price' =>100000,'quota' =>1,'bed' =>1,'description' =>'0','admins_id'=>3],
                        ['id'=>12,'name'=>'Merah3_2','image' =>'merah2.jpg','price' =>20000,'quota' =>2,'bed' =>2,'description' =>'0','admins_id'=>3],
                        ['id'=>13,'name'=>'Jingga3_1','image' =>'jingga1.jpg','price' =>100000,'quota' =>1,'bed' =>1,'description' =>'0','admins_id'=>3],
                        ['id'=>14,'name'=>'Jingga3_2','image' =>'jingga2.jpg','price' =>200000,'quota' =>2,'bed' =>2,'description' =>'0','admins_id'=>3],
                        ['id'=>15,'name'=>'Kuning3','image' =>'kuning.jpg','price' =>200000,'quota' =>1,'bed' =>1,'description'=>'0','admins_id'=>3]
                        ]);
    }
}
