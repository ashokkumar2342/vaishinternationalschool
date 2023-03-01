<ul class="users-list clearfix">
                    @foreach ($birthday_list as $studentDOB)
                    @php
                    $profile = route('admin.student.image',$studentDOB->picture);
                    @endphp
                    <li>
                      <img src="{{ ($studentDOB->picture)? $profile : asset('profile-img/user.png') }}" alt="{{ $studentDOB->name }}" style="width: 100px; height: 100px;  border: 2px solid #d1f7ec">
                      <a class="users-list-name">{{ $studentDOB->name }}</a>
                      <a class="users-list-name">{{date('d-M-Y',strtotime($studentDOB->dob))  }}</a>
                      <span class="users-list-date">{{ $studentDOB->class_name}}</span>
                    </li> 
                     @endforeach 
                  </ul> 
                </div>