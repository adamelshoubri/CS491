<template lang="html">
    <div class="row mb-5">
        <!--Survey questions-->
        <div class="col-md-12">
            <h1 class="mb-3">New Survey</h1>
            <div class="input-group mb-3">
                <span class="input-group-addon" id="basic-addon1">Survey Title</span>
                <input type="text" class="form-control" aria-describedby="questionHelp" :value="survey.title" v-model="survey.title" placeholder="Enter a survey title">
            </div>
            <h3  v-if="survey.questions.length == 0" class="text-muted mb-5">You have no questions. Add new survey questions by pressing "New Question"</h3>
             <!--TODO: Cesar: Fix collapse bug post-drag-->
            <draggable :list="survey.questions" id="accordion" role="tablist" :options="dragOptions" @end="reIndex">
                <!---Uses Question.vue file-->
                <question-type
                    v-for="question in survey.questions"
                    :question="question"
                    :key="question.id"
                    @destroy="destroyQuestion(question)"
                ></question-type>
            </draggable>
        </div>
        <!--Right sidebar currently disabled
        <div class="col-md-2">
            <div id="rightNav" role="tablist" class="mt-5">
              <div class="card">
                <div class="card-header" role="tab" id="newQuestionHeading">
                  <h5 class="mb-0">
                    <a class="nav-link" data-toggle="collapse" href="#collapseNewQuestion" aria-expanded="false" aria-controls="collapseNewQuestion">
                      New Question
                    </a>
                  </h5>
                </div>

                <div id="collapseNewQuestion" class="collapse" role="tabpanel" aria-labelledby="newQuestionHeading" data-parent="#rightNav">
                  <div class="card-body">
                      <h6 class="card-title">
                          Response Type
                      </h6>
                      <div class="block">
                          <button class="btn btn-link" type="button" @click="addNewQuestion('shorttext')">Text</button>
                      </div>
                      <div class="block">
                          <button class="btn btn-link" type="button" @click="addNewQuestion('slider')">Slider</button>
                      </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" role="tab" id="helpHeading">
                  <h5 class="mb-0">
                    <a class="nav-link" data-toggle="collapse" href="#collapseHelp" aria-expanded="false" aria-controls="collapseHelp">
                      Help
                    </a>
                  </h5>
                </div>

                <div id="collapseHelp" class="collapse" role="tabpanel" aria-labelledby="helpHeading" data-parent="#rightNav">
                  <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                  </div>
                </div>
              </div>
            </div>
        </div>
        -->
        <!--Fixed bottom nav-->
        <ul class="nav fixed-bottom navbar-light bg-light navbar-expand-lg container">
            <div class="btn-group dropup">
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                New Question
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
            <button class="btn btn-secondary" id="btn-toggle-collapse" @click="toggleCollapse">Collapse All</button>
            <button class="btn btn-success" @click="sendSurvey">Submit Survey</button>
            <!-- <a class="nav-link" href="#">Help</a> -->
        </ul>
    </div>
</template>

<script>


import draggable from 'vuedraggable';

export default {
    components:{
        draggable,
    },
    data() {
        return {
            lastQuestionId: 0,
            survey: {
                questions: [],
                title: ''
            },
            // TODO: Cesar: May or may not utilize array below
            // states: [],
            collapsed: false
        }
    },
    computed:{
        dragOptions(){
            return {
                animation: 150,
                draggable: '.card',
                handle: '.card-header',
                ghostClass: 'ghost',
                chosenClass: 'chosen',
                dragClass: 'drag'
            }
        }
    },
    methods: {
        createNewQuestion(type) {
            //Assign question properties common to all question types
            var question = {
                id: ++this.lastQuestionId,
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
                    question.dependents = {
                        condition: null,
                        response: null,
                        questions: []
                    }
                    break;
                case 'matrix': {
                    question.radios = [];
                    question.choices = [];
                }
            }

            this.survey.questions.push(question);
            this.scrollScreenDown();
            this.reIndex();
        },
        scrollScreenDown() {
            setTimeout(function(){
                $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
            }, 0.5);
        },
        destroyQuestion(question) {
            for(var i = 0; i < this.survey.questions.length; i++) {
                if (this.survey.questions[i].id === question.id) {
                    this.survey.questions.splice(i, 1);
                }
            }
            this.reIndex();
        },
        reIndex(){
            for( var i = 0; i < this.survey.questions.length; i++){
                this.survey.questions[i].id = i + 1;
            }
        },
        toggleCollapse() {
            if(this.collapsed) {
                $('.collapse-question').collapse("show");
                $('#btn-toggle-collapse').html("Collapse All");
            } else {
                $('.collapse-question').collapse("hide");
                $('#btn-toggle-collapse').html("Expand All");
            }

            this.collapsed = !this.collapsed;
        },
        sendSurvey(){
          axios.post('/surveys', {survey: this.survey}).then(
            (res) => {
              window.location.href = res.data.redirect;
              //console.log(res.data);
            }
          )
        }
    }
}
</script>
