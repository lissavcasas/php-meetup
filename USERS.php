<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/oracle_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'AL32UTF8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class DEMO_USERSPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('USERS');
            $this->SetMenuLabel('USERS');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                OracleConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"DEMO"."USERS"');
            $this->dataset->addFields(
                array(
                    new IntegerField('USER_ID', true, true),
                    new StringField('FIRST_NAME'),
                    new StringField('LAST_NAME'),
                    new StringField('USER_PHOTO'),
                    new StringField('EMAIL'),
                    new StringField('USERNAME'),
                    new StringField('USER_POSITION'),
                    new IntegerField('USER_PHONE'),
                    new IntegerField('USER_CELL_PHONE')
                )
            );
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'USER_ID', 'USER_ID', 'Id'),
                new FilterColumn($this->dataset, 'FIRST_NAME', 'FIRST_NAME', 'Nombre'),
                new FilterColumn($this->dataset, 'LAST_NAME', 'LAST_NAME', 'Apellido'),
                new FilterColumn($this->dataset, 'EMAIL', 'EMAIL', 'Correo'),
                new FilterColumn($this->dataset, 'USERNAME', 'USERNAME', 'Usuario'),
                new FilterColumn($this->dataset, 'USER_POSITION', 'USER_POSITION', 'Cargo'),
                new FilterColumn($this->dataset, 'USER_PHONE', 'USER_PHONE', 'Telefono'),
                new FilterColumn($this->dataset, 'USER_CELL_PHONE', 'USER_CELL_PHONE', 'Celular'),
                new FilterColumn($this->dataset, 'USER_PHOTO', 'USER_PHOTO', 'USER_PHOTO')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['USER_ID'])
                ->addColumn($columns['FIRST_NAME'])
                ->addColumn($columns['LAST_NAME'])
                ->addColumn($columns['EMAIL'])
                ->addColumn($columns['USERNAME'])
                ->addColumn($columns['USER_POSITION'])
                ->addColumn($columns['USER_PHONE'])
                ->addColumn($columns['USER_CELL_PHONE'])
                ->addColumn($columns['USER_PHOTO']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('user_id_edit');
            
            $filterBuilder->addColumn(
                $columns['USER_ID'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('first_name_edit');
            
            $filterBuilder->addColumn(
                $columns['FIRST_NAME'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('last_name_edit');
            
            $filterBuilder->addColumn(
                $columns['LAST_NAME'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('email_edit');
            
            $filterBuilder->addColumn(
                $columns['EMAIL'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('username_edit');
            
            $filterBuilder->addColumn(
                $columns['USERNAME'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('user_position_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['USER_POSITION'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('user_phone_edit');
            
            $filterBuilder->addColumn(
                $columns['USER_PHONE'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('user_cell_phone_edit');
            
            $filterBuilder->addColumn(
                $columns['USER_CELL_PHONE'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('USER_PHOTO');
            
            $filterBuilder->addColumn(
                $columns['USER_PHOTO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for USER_ID field
            //
            $column = new NumberViewColumn('USER_ID', 'USER_ID', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for FIRST_NAME field
            //
            $column = new TextViewColumn('FIRST_NAME', 'FIRST_NAME', 'Nombre', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_FIRST_NAME_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for LAST_NAME field
            //
            $column = new TextViewColumn('LAST_NAME', 'LAST_NAME', 'Apellido', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_LAST_NAME_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for EMAIL field
            //
            $column = new TextViewColumn('EMAIL', 'EMAIL', 'Correo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_EMAIL_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for USERNAME field
            //
            $column = new TextViewColumn('USERNAME', 'USERNAME', 'Usuario', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_USERNAME_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for USER_POSITION field
            //
            $column = new TextViewColumn('USER_POSITION', 'USER_POSITION', 'Cargo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_USER_POSITION_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for USER_PHONE field
            //
            $column = new NumberViewColumn('USER_PHONE', 'USER_PHONE', 'Telefono', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for USER_CELL_PHONE field
            //
            $column = new NumberViewColumn('USER_CELL_PHONE', 'USER_CELL_PHONE', 'Celular', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for USER_PHOTO field
            //
            $column = new ExternalImageViewColumn('USER_PHOTO', 'USER_PHOTO', 'USER_PHOTO', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for USER_ID field
            //
            $column = new NumberViewColumn('USER_ID', 'USER_ID', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for FIRST_NAME field
            //
            $column = new TextViewColumn('FIRST_NAME', 'FIRST_NAME', 'Nombre', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_FIRST_NAME_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for LAST_NAME field
            //
            $column = new TextViewColumn('LAST_NAME', 'LAST_NAME', 'Apellido', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_LAST_NAME_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for EMAIL field
            //
            $column = new TextViewColumn('EMAIL', 'EMAIL', 'Correo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_EMAIL_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for USERNAME field
            //
            $column = new TextViewColumn('USERNAME', 'USERNAME', 'Usuario', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_USERNAME_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for USER_POSITION field
            //
            $column = new TextViewColumn('USER_POSITION', 'USER_POSITION', 'Cargo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_USER_POSITION_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for USER_PHONE field
            //
            $column = new NumberViewColumn('USER_PHONE', 'USER_PHONE', 'Telefono', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for USER_CELL_PHONE field
            //
            $column = new NumberViewColumn('USER_CELL_PHONE', 'USER_CELL_PHONE', 'Celular', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for USER_PHOTO field
            //
            $column = new ExternalImageViewColumn('USER_PHOTO', 'USER_PHOTO', 'USER_PHOTO', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for USER_ID field
            //
            $editor = new TextEdit('user_id_edit');
            $editColumn = new CustomEditColumn('Id', 'USER_ID', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for FIRST_NAME field
            //
            $editor = new TextEdit('first_name_edit');
            $editColumn = new CustomEditColumn('Nombre', 'FIRST_NAME', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for LAST_NAME field
            //
            $editor = new TextEdit('last_name_edit');
            $editColumn = new CustomEditColumn('Apellido', 'LAST_NAME', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for EMAIL field
            //
            $editor = new TextEdit('email_edit');
            $editColumn = new CustomEditColumn('Correo', 'EMAIL', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new EMailValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('EmailValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for USERNAME field
            //
            $editor = new TextEdit('username_edit');
            $editColumn = new CustomEditColumn('Usuario', 'USERNAME', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for USER_POSITION field
            //
            $editor = new TextEdit('user_position_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Cargo', 'USER_POSITION', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for USER_PHONE field
            //
            $editor = new TextEdit('user_phone_edit');
            $editColumn = new CustomEditColumn('Telefono', 'USER_PHONE', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for USER_CELL_PHONE field
            //
            $editor = new TextEdit('user_cell_phone_edit');
            $editColumn = new CustomEditColumn('Celular', 'USER_CELL_PHONE', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for USER_PHOTO field
            //
            $editor = new ImageUploader('user_photo_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('USER_PHOTO', 'USER_PHOTO', $editor, $this->dataset, false, false, 'BIG_IMAG', '%original_file_name%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'USER_PHOTO',
                'SMALL_IMAG',
                Delegate::CreateFromMethod($this, 'USER_PHOTO_Thumbnail_GenerateFileName_edit'),
                new ImageFitByHeightResizeFilter(100),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for FIRST_NAME field
            //
            $editor = new TextEdit('first_name_edit');
            $editColumn = new CustomEditColumn('Nombre', 'FIRST_NAME', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for LAST_NAME field
            //
            $editor = new TextEdit('last_name_edit');
            $editColumn = new CustomEditColumn('Apellido', 'LAST_NAME', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for EMAIL field
            //
            $editor = new TextEdit('email_edit');
            $editColumn = new CustomEditColumn('Correo', 'EMAIL', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new EMailValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('EmailValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for USERNAME field
            //
            $editor = new TextEdit('username_edit');
            $editColumn = new CustomEditColumn('Usuario', 'USERNAME', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for USER_POSITION field
            //
            $editor = new TextEdit('user_position_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Cargo', 'USER_POSITION', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for USER_PHONE field
            //
            $editor = new TextEdit('user_phone_edit');
            $editColumn = new CustomEditColumn('Telefono', 'USER_PHONE', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for USER_CELL_PHONE field
            //
            $editor = new TextEdit('user_cell_phone_edit');
            $editColumn = new CustomEditColumn('Celular', 'USER_CELL_PHONE', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for USER_PHOTO field
            //
            $editor = new ImageUploader('user_photo_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('USER_PHOTO', 'USER_PHOTO', $editor, $this->dataset, false, false, 'BIG_IMAG', '%original_file_name%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'USER_PHOTO',
                'SMALL_IMAG',
                Delegate::CreateFromMethod($this, 'USER_PHOTO_Thumbnail_GenerateFileName_multi_edit'),
                new ImageFitByHeightResizeFilter(100),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for USER_ID field
            //
            $editor = new TextEdit('user_id_edit');
            $editColumn = new CustomEditColumn('Id', 'USER_ID', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for FIRST_NAME field
            //
            $editor = new TextEdit('first_name_edit');
            $editColumn = new CustomEditColumn('Nombre', 'FIRST_NAME', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for LAST_NAME field
            //
            $editor = new TextEdit('last_name_edit');
            $editColumn = new CustomEditColumn('Apellido', 'LAST_NAME', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for EMAIL field
            //
            $editor = new TextEdit('email_edit');
            $editColumn = new CustomEditColumn('Correo', 'EMAIL', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new EMailValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('EmailValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for USERNAME field
            //
            $editor = new TextEdit('username_edit');
            $editColumn = new CustomEditColumn('Usuario', 'USERNAME', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for USER_POSITION field
            //
            $editor = new TextEdit('user_position_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Cargo', 'USER_POSITION', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for USER_PHONE field
            //
            $editor = new TextEdit('user_phone_edit');
            $editColumn = new CustomEditColumn('Telefono', 'USER_PHONE', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for USER_CELL_PHONE field
            //
            $editor = new TextEdit('user_cell_phone_edit');
            $editColumn = new CustomEditColumn('Celular', 'USER_CELL_PHONE', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for USER_PHOTO field
            //
            $editor = new ImageUploader('user_photo_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('USER_PHOTO', 'USER_PHOTO', $editor, $this->dataset, false, false, 'BIG_IMAG', '%original_file_name%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'USER_PHOTO',
                'SMALL_IMAG',
                Delegate::CreateFromMethod($this, 'USER_PHOTO_Thumbnail_GenerateFileName_insert'),
                new ImageFitByHeightResizeFilter(100),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for USER_ID field
            //
            $column = new NumberViewColumn('USER_ID', 'USER_ID', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for FIRST_NAME field
            //
            $column = new TextViewColumn('FIRST_NAME', 'FIRST_NAME', 'Nombre', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_FIRST_NAME_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for LAST_NAME field
            //
            $column = new TextViewColumn('LAST_NAME', 'LAST_NAME', 'Apellido', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_LAST_NAME_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for EMAIL field
            //
            $column = new TextViewColumn('EMAIL', 'EMAIL', 'Correo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_EMAIL_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for USERNAME field
            //
            $column = new TextViewColumn('USERNAME', 'USERNAME', 'Usuario', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_USERNAME_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for USER_POSITION field
            //
            $column = new TextViewColumn('USER_POSITION', 'USER_POSITION', 'Cargo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_USER_POSITION_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for USER_PHONE field
            //
            $column = new NumberViewColumn('USER_PHONE', 'USER_PHONE', 'Telefono', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for USER_CELL_PHONE field
            //
            $column = new NumberViewColumn('USER_CELL_PHONE', 'USER_CELL_PHONE', 'Celular', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for USER_PHOTO field
            //
            $column = new ExternalImageViewColumn('USER_PHOTO', 'USER_PHOTO', 'USER_PHOTO', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for USER_ID field
            //
            $column = new NumberViewColumn('USER_ID', 'USER_ID', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for FIRST_NAME field
            //
            $column = new TextViewColumn('FIRST_NAME', 'FIRST_NAME', 'Nombre', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_FIRST_NAME_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for LAST_NAME field
            //
            $column = new TextViewColumn('LAST_NAME', 'LAST_NAME', 'Apellido', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_LAST_NAME_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for EMAIL field
            //
            $column = new TextViewColumn('EMAIL', 'EMAIL', 'Correo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_EMAIL_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for USERNAME field
            //
            $column = new TextViewColumn('USERNAME', 'USERNAME', 'Usuario', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_USERNAME_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for USER_POSITION field
            //
            $column = new TextViewColumn('USER_POSITION', 'USER_POSITION', 'Cargo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_USER_POSITION_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for USER_PHONE field
            //
            $column = new NumberViewColumn('USER_PHONE', 'USER_PHONE', 'Telefono', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for USER_CELL_PHONE field
            //
            $column = new NumberViewColumn('USER_CELL_PHONE', 'USER_CELL_PHONE', 'Celular', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for USER_PHOTO field
            //
            $column = new ExternalImageViewColumn('USER_PHOTO', 'USER_PHOTO', 'USER_PHOTO', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for USER_ID field
            //
            $column = new NumberViewColumn('USER_ID', 'USER_ID', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for FIRST_NAME field
            //
            $column = new TextViewColumn('FIRST_NAME', 'FIRST_NAME', 'Nombre', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_FIRST_NAME_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for LAST_NAME field
            //
            $column = new TextViewColumn('LAST_NAME', 'LAST_NAME', 'Apellido', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_LAST_NAME_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for EMAIL field
            //
            $column = new TextViewColumn('EMAIL', 'EMAIL', 'Correo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_EMAIL_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for USERNAME field
            //
            $column = new TextViewColumn('USERNAME', 'USERNAME', 'Usuario', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_USERNAME_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for USER_POSITION field
            //
            $column = new TextViewColumn('USER_POSITION', 'USER_POSITION', 'Cargo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DEMO_USERSGrid_USER_POSITION_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for USER_PHONE field
            //
            $column = new NumberViewColumn('USER_PHONE', 'USER_PHONE', 'Telefono', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for USER_CELL_PHONE field
            //
            $column = new NumberViewColumn('USER_CELL_PHONE', 'USER_CELL_PHONE', 'Celular', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for USER_PHOTO field
            //
            $column = new ExternalImageViewColumn('USER_PHOTO', 'USER_PHOTO', 'USER_PHOTO', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        public function USER_PHOTO_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'SMALL_IMAG');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVariablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function USER_PHOTO_Thumbnail_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'SMALL_IMAG');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVariablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function USER_PHOTO_Thumbnail_GenerateFileName_multi_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'SMALL_IMAG');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVariablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for FIRST_NAME field
            //
            $column = new TextViewColumn('FIRST_NAME', 'FIRST_NAME', 'Nombre', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_FIRST_NAME_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for LAST_NAME field
            //
            $column = new TextViewColumn('LAST_NAME', 'LAST_NAME', 'Apellido', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_LAST_NAME_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for EMAIL field
            //
            $column = new TextViewColumn('EMAIL', 'EMAIL', 'Correo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_EMAIL_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for USERNAME field
            //
            $column = new TextViewColumn('USERNAME', 'USERNAME', 'Usuario', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_USERNAME_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for USER_POSITION field
            //
            $column = new TextViewColumn('USER_POSITION', 'USER_POSITION', 'Cargo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_USER_POSITION_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for FIRST_NAME field
            //
            $column = new TextViewColumn('FIRST_NAME', 'FIRST_NAME', 'Nombre', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_FIRST_NAME_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for LAST_NAME field
            //
            $column = new TextViewColumn('LAST_NAME', 'LAST_NAME', 'Apellido', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_LAST_NAME_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for EMAIL field
            //
            $column = new TextViewColumn('EMAIL', 'EMAIL', 'Correo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_EMAIL_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for USERNAME field
            //
            $column = new TextViewColumn('USERNAME', 'USERNAME', 'Usuario', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_USERNAME_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for USER_POSITION field
            //
            $column = new TextViewColumn('USER_POSITION', 'USER_POSITION', 'Cargo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_USER_POSITION_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for FIRST_NAME field
            //
            $column = new TextViewColumn('FIRST_NAME', 'FIRST_NAME', 'Nombre', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_FIRST_NAME_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for LAST_NAME field
            //
            $column = new TextViewColumn('LAST_NAME', 'LAST_NAME', 'Apellido', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_LAST_NAME_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for EMAIL field
            //
            $column = new TextViewColumn('EMAIL', 'EMAIL', 'Correo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_EMAIL_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for USERNAME field
            //
            $column = new TextViewColumn('USERNAME', 'USERNAME', 'Usuario', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_USERNAME_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for USER_POSITION field
            //
            $column = new TextViewColumn('USER_POSITION', 'USER_POSITION', 'Cargo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_USER_POSITION_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for FIRST_NAME field
            //
            $column = new TextViewColumn('FIRST_NAME', 'FIRST_NAME', 'Nombre', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_FIRST_NAME_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for LAST_NAME field
            //
            $column = new TextViewColumn('LAST_NAME', 'LAST_NAME', 'Apellido', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_LAST_NAME_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for EMAIL field
            //
            $column = new TextViewColumn('EMAIL', 'EMAIL', 'Correo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_EMAIL_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for USERNAME field
            //
            $column = new TextViewColumn('USERNAME', 'USERNAME', 'Usuario', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_USERNAME_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for USER_POSITION field
            //
            $column = new TextViewColumn('USER_POSITION', 'USER_POSITION', 'Cargo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DEMO_USERSGrid_USER_POSITION_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomPagePermissions(Page $page, PermissionSet &$permissions, &$handled)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new DEMO_USERSPage("DEMO_USERS", "USERS.php", GetCurrentUserPermissionSetForDataSource("DEMO.USERS"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("DEMO.USERS"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
