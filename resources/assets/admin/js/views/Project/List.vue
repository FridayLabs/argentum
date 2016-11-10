<template>
    <div class="container">
        <div class="row-flex header">
            <div class="col-xs-6">
                <h2>My Websites</h2>
            </div>
            <div class="col-xs-6 text-right">
                <a class="btn btn-success">
                    <i class="fa fa-plus" aria-hidden="true"></i> Start new website
                </a>
            </div>
        </div>
        <div class="row">
            <div v-for="project in projects" class="col-xs-6">
                <div class="panel panel-default project">
                    <router-link :to="{name: 'project', params: {project_id : project.id}}">
                        <div class="panel-body">
                            <h3>{{project.name}}</h3>
                            <p>{{project.description}}</p>
                        </div>
                    </router-link>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                <router-link :to="{name: 'project', params: {project_id : project.id}}">
                                    Edit website
                                </router-link>
                            </div>
                            <div class="col-sm-8 hidden-xs text-right">
                                <i class="fa fa-external-link" aria-hidden="true"></i>
                                <a href="#" target="_blank">
                                    http://{{project.domain}}
                                </a>
                            </div>
                            <div class="col-sm-8 visible-xs">
                                <i class="fa fa-external-link" aria-hidden="true"></i>
                                <a href="#" target="_blank">
                                    http://{{project.domain}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="!projects.length" class="col-xs-12 text-center">
                Not found any websites. <br/>
                Create one by clicking to "Start new website" button.
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                projects: [
                    {
                        id: 123,
                        name: 'Foobar',
                        description: 'test website NENASTOYASHIY',
                        domain: 'foobar.argentum.com',
                    }
                ]
            };
        }
    }
</script>

<style>
    .header {
        margin-bottom: 20px;
    }

    .project .panel-body {
        color: #666666;
        padding: 20px;
        min-height: 200px;
    }

    .project:hover {
        background-color: #fefefe;
    }

    .project h3 {
        margin: 10px 0;
    }
</style>