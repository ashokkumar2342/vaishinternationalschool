 <table class="table"> 
                    <thead>
                      <tr>
                        <th>Class</th>
                        <th>Subject</th>
                        <th>Maximum Marks</th>
                        <th>Test Date</th>
                        <th>Descriptoin</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($classtest_list as $classTest)
                      <tr>
                        <td>{{ $classTest->class_name}}</td>
                        <td>{{ $classTest->name}}</td>
                        <td>{{ $classTest->max_marks }}</td>
                        <td>{{ $classTest->test_date }}</td>
                        <td>{{ $classTest->discription }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>