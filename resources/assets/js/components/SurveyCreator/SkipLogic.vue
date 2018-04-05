<template lang="html">
    <div id="skip-logic">
        <h6 class="card=subtitle mt-3">Conditions to show dependent questions</h6>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Condition</label>
            <select class="form-control" id="" v-model="question.dependents.condition">
                <option value=null selected disabled hidden>Choose here</option>
                <option value="equal">equal to</option>
                <option value="not-equal">not equal to</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Response</label>
            <select class="form-control" id="" v-model="question.dependents.response">
                <option value=null selected disabled hidden>Choose here</option>
                <option v-for="choice in question.choices" :key="question.id">{{ choice.text }}</option>
            </select>
        </div>
        <h6 class="card=subtitle mt-3">Dependent Questions</h6>
        <div class="btn-group dropdown">
          <button type="button" class="btn btn-primary dropdown-toggle mb-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            New Dependent Question
          </button>
          <div class="dropdown-menu">
            <h6 class="dropdown-header">Response Type</h6>
            <button class="dropdown-item" type="button" @click="createNewQuestion('shorttext')">Text</button>
            <button class="dropdown-item" type="button" @click="createNewQuestion('slider')">Slider</button>
            <button class="dropdown-item" type="button" @click="createNewQuestion('radio')">Radio</button>
            <button class="dropdown-item" type="button" @click="createNewQuestion('sortable')">Sortable List</button>
            <button class="dropdown-item" type="button" @click="createNewQuestion('matrix')">Matrix</button>
          </div>
        </div>
        <question-type
            v-for="question in question.dependents.questions"
            :id="'dependent-question-' + question.id"
            :question="question"
            :key="question.id"
            @destroy="destroyQuestion(question)"
        ></question-type>
    </div>
</template>

<script>
export default {
    data() {
        return {
            //DMITRY: Skiplogic question IDs conflict with top-level questions
            //This is not the right way to do this but I'm lazy
            lastQuestionId: -1
        }
    },
    props: ['question'],
    methods: {
        //DMITRY: Violating DRY with these redundant methods
        //TODO: fix aforementioned DRY violation
        createNewQuestion(type) {
            //Assign question properties common to all question types
            var question = {
                id: --this.lastQuestionId, //see comment above
                type: type,
                text: null,
                required: true
            };

            //Assign type-specific question properties
            switch(type) {
                case 'slider':
                    question.slidermin = "0";
                    question.slidermax = "100";
                    question.increment = "1";
                    break;
                case 'sortable':
                case 'radio':
                    question.choices = [];
                    break;
                case 'matrix': {
                    question.radios = [];
                    question.items = [];
                }
            }

            this.question.dependents.questions.push(question);
            this.scrollScreenDown('#dependent-question-' + question.id);
        },
        destroyQuestion(question) {
            for(var i = 0; i < this.question.dependents.questions.length; i++) {
                if (this.question.dependents.questions[i].id === question.id) {
                    this.question.dependents.questions.splice(i, 1);
                }
            }
            this.reIndex();
        },
        reIndex(){
            for( var i = 0; i < this.question.dependents.questions.length; i++){
                this.question.dependents.questions[i].id = i + 1;
            }
        },
        scrollScreenDown(questionElement) {
            setTimeout(function(){
                $("html, body").animate({ scrollTop: $(questionElement).offset().top });
            }, 0.5);
        },
    }
}
</script>

<style lang="css">
</style>
