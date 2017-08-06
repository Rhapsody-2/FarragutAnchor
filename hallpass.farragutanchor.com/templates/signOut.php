            <h1 style="text-align: center; color: #1B2845">Hallpass</h1>
            <form method="post">
                <fieldset style="width: 50%; margin: auto">
                    <div class="row" style="margin: 0">
                        <div class="input-field col s12">
                             <input name="teacher" id="teacher" type="text" class="autocomplete validate" autocomplete="off" required>
                            <label for="teacher">Teacher</label>
                        </div>
                    </div>
                    <div class="row" style="margin: 0">
                        <div class="input-field col s12">
                            <select id="dest" name="dest" onchange="checkOther(this);" required>
                                <option value="Bathroom">Bathroom</option>
                                <option value="Library">Library</option>
                                <option value="Guidance">Guidance</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Student Affairs">Student Affairs</option>
                                <option value="Main Office">Main Office</option>
                                <option value="Curriculum Office">Curriculum Office</option>
                                <option value="Clinic">Clinic</option>
                                <option value="Gym">Gym</option>
                                <option value="CTE">CTE</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 0; display: none" id="othTeacherDiv">
                        <div class="input-field col s12" id="othTeacher">
                            <input name="teacherAuto" type="text" id="teacherAuto" class="autocomplete" autocomplete="off">
                            <label for="teacherAuto">Teacher</label>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px; display: block" id="bathroom">
                        <div class="input-field col s12" id="br" style="margin-top: 0">
                            <p style="margin-top: 0">
                                <input name="brID" id="0" type="radio" value="Yellow Wing">
                                <label for="0" style="color: #000">Yellow Wing</label>
                            </p>
                            <p style="margin-top: 0">
                                <input name="brID" id="1" type="radio" value="Orange Wing (Upstairs)">
                                <label for="1" style="color: #000">Orange Wing (Upstairs)</label>
                            </p>
                            <p style="margin-top: 0">
                                <input name="brID" id="2" type="radio" value="Orange Wing (Downstairs)">
                                <label for="2" style="color: #000">Orange Wing (Downstairs)</label>
                            </p>
                            <p style="margin-top: 0">
                                <input name="brID" id="3" type="radio" value="Green Wing (Upstairs)">
                                <label for="3" style="color: #000">Green Wing (Upstairs)</label>
                            </p>
                            <p style="margin-top: 0">
                                <input name="brID" id="4" type="radio" value="Green Wing (Downstairs)">
                                <label for="4" style="color: #000">Green Wing (Downstairs)</label>
                            </p>
                            <p style="margin-top: 0">
                                <input name="brID" id="5" type="radio" value="CTE Building">
                                <label for="5" style="color: #000">CTE Building</label>
                            </p>
                            <p style="margin-top: 0">
                                <input name="brID" id="6" type="radio" value="Music Wing">
                                <label for="6" style="color: #000">Music Wing</label>
                            </p>
                            <p style="margin-top: 0">
                                <input name="brID" id="7" type="radio" value="Gym Commons">
                                <label for="7" style="color: #000">Gym Commons</label>
                            </p>
                        </div>
                    </div>
                <?php include("../farragutanchor.com/templates/errors.php"); ?>
                </fieldset>
                <input name="action" value="out" type="hidden">
                <p style="text-align: center; padding-bottom: 50px;">
                    <button class="btn waves-effect waves-light" type="submit">Sign Out</button>
                </p>
            </form>
