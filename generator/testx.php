<?php
$sql="UPDATE `ifinancial`.`generalLedgerChartOfAccount` SET  `generalLedgerChartOfAccountId` = '".$this->model->getGeneralLedgerChartOfAccountId()."', `generalLedgerChartOfAccountTitle` = '".$this->model->getGeneralLedgerChartOfAccountTitle()."', `generalLedgerChartOfAccountDesc` = '".$this->model->getGeneralLedgerChartOfAccountDesc()."', `generalLedgerChartOfAccountNo` = '".$this->model->getGeneralLedgerChartOfAccountNo()."', `generalLedgerChartOfAccountTypeId` = '".$this->model->getGeneralLedgerChartOfAccountTypeId()."', `generalLedgerChartOfAccountReportTypeId` = '".$this->model->getGeneralLedgerChartOfAccountReportTypeId()."', `isDefault` = '".$this->model->getIsDefault(0, 'single')."', `isNew` = '".$this->model->getIsNew(0, 'single')."', `isDraft` = '".$this->model->getIsDraft(0, 'single')."', `isUpdate` = '".$this->model->getIsUpdate(0, 'single')."', `isDelete` = '".$this->model->getIsDelete(0, 'single')."', `isActive` = '".$this->model->getIsActive(0, 'single')."', `isApproved` = '".$this->model->getIsApproved(0, 'single')."', `isReview` = '".$this->model->getIsReview(0, 'single')."', `isPost` = '".$this->model->getIsPost(0, 'single')."', `isConsolidation` = '".$this->model->getIsConsolidation(0, 'single')."', `isSeperated` = '".$this->model->getIsSeperated(0, 'single')."', `executeBy` = '".$this->model->getExecuteBy()."', `executeTime` = '".$this->model->getExecuteTime()."', `generalLedgerChartOfAccountId` = '".$this->model->getGeneralLedgerChartOfAccountId()."', `generalLedgerChartOfAccountTitle` = '".$this->model->getGeneralLedgerChartOfAccountTitle()."', `generalLedgerChartOfAccountDesc` = '".$this->model->getGeneralLedgerChartOfAccountDesc()."', `generalLedgerChartOfAccountNo` = '".$this->model->getGeneralLedgerChartOfAccountNo()."', `generalLedgerChartOfAccountTypeId` = '".$this->model->getGeneralLedgerChartOfAccountTypeId()."', `generalLedgerChartOfAccountReportTypeId` = '".$this->model->getGeneralLedgerChartOfAccountReportTypeId()."', `isDefault` = '".$this->model->getIsDefault(0, 'single')."', `isNew` = '".$this->model->getIsNew(0, 'single')."', `isDraft` = '".$this->model->getIsDraft(0, 'single')."', `isUpdate` = '".$this->model->getIsUpdate(0, 'single')."', `isDelete` = '".$this->model->getIsDelete(0, 'single')."', `isActive` = '".$this->model->getIsActive(0, 'single')."', `isApproved` = '".$this->model->getIsApproved(0, 'single')."', `isReview` = '".$this->model->getIsReview(0, 'single')."', `isPost` = '".$this->model->getIsPost(0, 'single')."', `isConsolidation` = '".$this->model->getIsConsolidation(0, 'single')."', `isSeperated` = '".$this->model->getIsSeperated(0, 'single')."', `executeBy` = '".$this->model->getExecuteBy()."', `executeTime` = '".$this->model->getExecuteTime()."' WHERE `generalLedgerChartOfAccountId`='".getGeneralLedgerChartOfAccountId('0','single')."'";
$sql="      UPDATE  `ifinancial`.`generalLedgerChartOfAccount`
            SET     `isDefault`             =   '" . $this->model->getIsDefault(0, 'single') . "',
                    `isNew`                 =   '" . $this->model->getIsNew(0, 'single') . "',
                    `isDraft`               =   '" . $this->model->getIsDraft(0, 'single') . "',
                    `isUpdate`              =   '" . $this->model->getIsUpdate(0, 'single') . "',
                    `isDelete`              =   '" . $this->model->getIsDelete(0, 'single') . "',
                    `isActive`              =   '" . $this->model->getIsActive(0, 'single') . "',
                    `isApproved`            =   '" . $this->model->getIsApproved(0, 'single') . "',
                    `isReview`              =   '" . $this->model->getIsReview(0, 'single') . "',
                    `isPost`                =   '" . $this->model->getIsPost(0, 'single') . "',
                    `executeBy`             =   '" . $this->model->getExecuteBy() . "',
                    `executeTime`           =   " . $this->model->getExecuteTime() . "
            WHERE   `generalLedgerChartOfAccountId` =  '" . $this->model->getGeneralLedgerChartOfAccountId(0, 'single') . "'";
?>