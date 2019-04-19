<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->integer('post_id');
            $table->integer('tag_id');
            $table->primary(['post_id', 'tag_id']);
        });
        $post = range(1,20);
        $tags = [1,2];
        $post_count = count($post);
        DB::statement('INSERT INTO `tags` (`id`, `name`) VALUES (NULL, \'generic\'), (NULL, \'php\')');
        DB::statement('INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES (\'2\', \'2\'), (\'3\', \'1\')');

        /*for($i = 0; $i < $post_count; $i++) {
            DB::statement('INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES ('.array_rand($post).', '.array_rand($tags).')');
        }*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('post_tag');
    }
}
