<!--This file exists in order to encapsulate 'Question Type' rendering -->
<!--Handle 'bug' of rendering question types in the wrong order-->
<template>
    <div class="card mb-3">
        <div class="card-header" role="tab" id="headingOne">
            <div class="question-control float-right">
            <button type="button" class="btn btn-primary collapse-handler" aria-label="Collapse" :data-target="'#collapse' + question.id" data-toggle="collapse">
            </button>
            <button type="button" class="btn btn-danger delete-question" aria-label="Close" @click="destroy">
            </button>
            </div>
            <h6 class="mb-0">
                 <span class="question-type">{{question.type}} question: </span><span class="question-text">{{question.text}}</span>
            </h6>
        </div>
        <div :id="'collapse' + question.id" class="collapse-question collapse show" role="tabpanel" aria-labelledby="headingOne">
            <div class="card-body">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Question Text</span>
                    <input type="text" class="form-control" aria-describedby="questionHelp" :value="question.text" v-model="question.text">
                </div>
                <small class="form-text text-muted mb-3">Enter your question text as you would like it to appear in the survey.</small>
                <div id="question-specific">
                    <text-question
                            v-if="question.type == 'shorttext' ||
                            question.type == 'textarea' ||
                            question.type == 'number' ||
                            question.type == 'date'"
                            :question="question"
                            :key="question.id"
                            @destroy="destroy(question)"
                    ></text-question>
                    <slider-question
                            v-if="question.type == 'slider'"
                            :question="question"
                            :key="question.id"
                            @destroy="destroy(question)"
                    >
                    </slider-question>
                    <radio-question
                            v-if="question.type == 'radio' || question.type == 'checkbox'"
                            :question="question"
                            :key="question.id"
                            @destroy="destroy(question)"
                    >
                    </radio-question>
                    <sortable-question
                            v-if="question.type == 'sortable'"
                            :question="question"
                            :key="question.id"
                            @destroy="destroy(question)"
                    >
                    </sortable-question>
                    <matrix-question
                            v-if="question.type == 'matrix'"
                            :question="question"
                            :key="question.id"
                            @destroy="destroy(question)"
                            @isDependent="isDependent()"
                    >
                    </matrix-question>
                </div>
                <div class="form-check">
                  <label class="form-check-label float-right">
                    <input class="form-check-input" type="checkbox" value="" checked="true" @click="toggleRequired" v-model="question.required">
                    Answer required
                  </label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props: ['question'],
        methods:{
            destroy(question){
                this.$emit('destroy', question);
            },
            toggleRequired() {
                this.question.required ? false : true;
            }
        }
    }
</script>
