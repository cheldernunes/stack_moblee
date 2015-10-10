<!-- BEGIN CONTENT SECTION -->
<div>
    <section class="bg-master-lightest p-b-85 p-t-75">
        <div class="container">
            <div class="md-p-l-20 md-p-r-20 xs-no-padding">
                <div class="row">
                    <div class="col-sm-12">
                        <a class="btn btn-complete" ng-click="sync(page)">{{ message }}</a>
                        {{ status }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-7">
                        <h2>Buscar Na Api</h2>
                        <?php echo $this->Form->create(array('novalidate','onSubmit'=>'return false;')); ?>
                            <table>
                                <tr>
                                    <td><?php echo $this->Form->input('page',array('ng-model'=>'pg')); ?></td>
                                    <td><?php echo $this->Form->input('rpp',array('ng-model'=>'rpp')); ?></td>
                                    <td><?php echo $this->Form->input('sort',array('ng-model'=>'sort','type'=>'select',
                                            'options'=>array(
                                                'question_id_i'=>'question_id',
                                                'title_s'=>'title',
                                                'owner_name_s'=>'owner_name',
                                                'score_i'=>'score',
                                                'creation_date_l'=>'creation_date',
                                                'link_s'=>'link',
                                                'is_answered_b'=>'is_answered'))); ?></td>
                                    <td><?php echo $this->Form->input('score',array('ng-model'=>'score')); ?></td>
                                </tr>
                            </table>
                        <button class="btn btn-info pull-right m-t-20" ng-click="search()">Buscar</button>
                        <?php echo $this->form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="p-t-50">
        <div class="container">
            <pre ng-show="code" ng-bind-html="code"></pre>
        </div>
    </section>
    </div>
<!-- END CONTENT SECTION -->