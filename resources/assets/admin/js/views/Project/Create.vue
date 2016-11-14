<template>
    <div class="container">
        <PageHeader title="Create website"></PageHeader>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <form @submit.prevent="create()">
                    <div :class="['form-group-lg', errors.has('title') ? 'has-error': '']">
                        <label class="control-label">Project Name</label>
                        <input class="form-control" type="text" placeholder="Best website ever" data-as="Project name"
                               v-model="title" v-validate.initial="title" data-rules="required|max:25">
                        <span v-if="errors.has('title')" class="help-block">{{errors.first('title')}}</span>
                    </div>

                    <div :class="['form-group-lg', errors.has('description') ? 'has-error': '']">
                        <label class="control-label">Description</label>
                        <textarea rows="3" class="form-control" data-as="Project description"
                                  placeholder="Description of website"
                                  v-model="description" v-validate.initial="description" data-rules="max:255">
                        </textarea>
                        <span v-if="errors.has('description')" class="help-block">{{errors.first('description')}}</span>
                    </div>
                    <div class="form-group-lg text-right">
                        <button class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                title: '',
                description: '',
            };
        },
        methods: {
            create() {
                this.$validator.validateAll()
                if (this.errors.any()) return;
            }
        }
    }
</script>